pragma solidity ^0.4.0;

contract FoodCentral{
    
    address private contractOwner;
    // fee to add new store
    uint256 private storeFee;
    // array of storeHashes on the contract
    bytes32[] storeArray;
    
    // get transaction array using buyer address
    mapping(address => bytes32[]) buyerTransactionsArray;
    
   // mapping(address => bytes32[]) getStoreArray;
   
   // get storeHash using transactionHash
    mapping(bytes32=>bytes32) getStoreByTransaction;
    
    // get transactions by storeHash
    mapping(bytes32 => TransactionDetails[]) transactionsByStore;
    // get Owner details using owner address
    mapping(address => Owner) storeOwner; 
    
    // get storeDetails using storeHash
    mapping(bytes32=>Store) store;
    
    struct TransactionDetails{
        uint amount;
        address buyer;
        address seller;
        bytes32 storeHash;
        bytes32 transactionHash;
        string typeOfTrans;
        bool paymentReceived;
        bool delivered;
        string status;
    }
    
    struct Owner{
        bool isStoreOwner;
        address ownerAddress;
        bytes32[] stores;
    }
    
    struct Store{
        address owner;
        string name;
       
       //transactionHAsh
        mapping(bytes32=>TransactionDetails) transactions;
    }
    
    constructor() public{
        contractOwner=msg.sender;
        storeFee=24 finney;
    }
    
    modifier onlyOwner(){
        require(msg.sender == contractOwner);
        _;
    }
    
    modifier isStoreOwner(address _storeOwner){
        require(storeOwner[_storeOwner].isStoreOwner);
        _;
    }
    
     function isSellerAccount() public view returns(bool){
        if(storeOwner[msg.sender].isStoreOwner){
         return true;   
        }else{
        return false;
        }
    }
    
    // Change Store Registration fee
    // Change if sender is contract owner
    function setStoreFee(uint256 _storeFee) public onlyOwner{
        require(_storeFee!=0);
        storeFee=_storeFee;
    }
    
    function getStoreFee() public view returns(uint256){
        return storeFee;
    }
    
    
    function getStoreHashByIndex(uint256 _index) public view returns(bytes32){
        return storeArray[_index];
    }
    
    function addStore(string _storeName) public payable{
        require(msg.value == storeFee);
        
        bytes32 storeHash= keccak256(abi.encodePacked(msg.sender,_storeName,now));
       // ownerStores[msg.sender].push(keccak256(abi.encodePacked(msg.sender,_storeName,now)));
        Owner storage o= storeOwner[msg.sender];
        o.ownerAddress= msg.sender;
        o.isStoreOwner=true;
        o.stores.push(storeHash);
        
        Store storage s=store[storeHash];
        s.owner= msg.sender;
        s.name=_storeName;
       
        contractOwner.transfer(msg.value);
        storeArray.push(storeHash);
    }
    
    function getStoreCount() public view returns(uint256){
        return storeArray.length;
    }
    
    //for testing only
    function getStoreOwner(bytes32 _storeHash) public view returns(address){
       
        return (store[_storeHash].owner);
    }
    
   function addTransaction(bytes32 _storeHash,string _typeOfTrans,uint256 _itemHash) public payable returns(bytes32) {
       require(msg.value != 0);
        uint _amount = msg.value;
        TransactionDetails memory transactionDetails;
        // transactionsByStore[_storeHash].push(transactDetails);
       
       
        bytes32 transactionHash=keccak256(abi.encodePacked(_amount, _storeHash,_typeOfTrans,_itemHash ,now));
       
        transactionDetails.amount=_amount;
        transactionDetails.buyer=msg.sender;
        transactionDetails.seller= store[_storeHash].owner;
        transactionDetails.storeHash=_storeHash;
        transactionDetails.transactionHash=transactionHash;
        transactionDetails.typeOfTrans = _typeOfTrans;
        transactionDetails.paymentReceived=false;
        transactionDetails.delivered=false;
        transactionDetails.status='pending';
        getStoreByTransaction[transactionHash]=_storeHash;
        store[_storeHash].transactions[transactionHash]=transactionDetails;
        
        buyerTransactionsArray[msg.sender].push(transactionHash) ;
        
        return(transactionHash);
        
   }
   
   function getTransactionStatus(bytes32 _transactionHash) public view returns(string,bool,bool,string){
  
    bytes32 storeHash=getStoreByTransaction[_transactionHash];
       Store storage s = store[storeHash];
       return (s.transactions[_transactionHash].typeOfTrans,
            s.transactions[_transactionHash].paymentReceived,
             s.transactions[_transactionHash].delivered,
               s.transactions[_transactionHash].status);
   }
   
   function getTransactionDetails(bytes32 _transactionHash) public view returns(uint,address,address,bytes32){
  
    bytes32 storeHash=getStoreByTransaction[_transactionHash];
       Store storage s = store[storeHash];
       return (s.transactions[_transactionHash].amount,
       s.transactions[_transactionHash].buyer,
        s.transactions[_transactionHash].seller,
         s.transactions[_transactionHash].storeHash);
   }
   
   function test(bytes32 _transactionHash) public view returns(uint){
        bytes32 storeHash=getStoreByTransaction[_transactionHash];
        Store storage s = store[storeHash];
        
        
        return (s.transactions[_transactionHash].amount);
   }
   
   function getBuyerTransactions(uint256 index) public view returns(bytes32){
       return buyerTransactionsArray[msg.sender][index];
   }
   
   function getBuyerTransactionLength() public view returns(uint){
       return buyerTransactionsArray[msg.sender].length;
   }
    
    function confirmDelivery(bytes32 _transactionHash) public payable{
        
        bytes32 storeHash=getStoreByTransaction[_transactionHash];
        Store storage s = store[storeHash];
        require(msg.sender ==  s.transactions[_transactionHash].seller );
        s.transactions[_transactionHash].delivered=true;
        s.transactions[_transactionHash].status='delivered';
        
        
        if(s.transactions[_transactionHash].paymentReceived){
            s.transactions[_transactionHash].status='completed'; 
            s.transactions[_transactionHash].seller.transfer(s.transactions[_transactionHash].amount);
        }else{
            s.transactions[_transactionHash].status='delivered'; 
        }
        s.transactions[_transactionHash].delivered=true;
    }
    
    function confirmPayment(bytes32 _transactionHash) public payable{
        bytes32 storeHash=getStoreByTransaction[_transactionHash];
        Store storage s = store[storeHash];
        require(msg.sender ==  s.transactions[_transactionHash].buyer);
        if(s.transactions[_transactionHash].delivered){
            s.transactions[_transactionHash].status='completed'; 
            s.transactions[_transactionHash].seller.transfer(s.transactions[_transactionHash].amount);
        }else{
            s.transactions[_transactionHash].status='paid'; 
        }
        s.transactions[_transactionHash].paymentReceived=true;
        
    }
    
    
    
    
  
   
    
    
    
}