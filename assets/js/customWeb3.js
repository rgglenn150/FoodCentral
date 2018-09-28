if (typeof web3 !== 'undefined') {
    web3 = new Web3(web3.currentProvider);
    console.log(web3.currentProvider);
    //sessionStorage.setItem("web3CurrentProvider", web3.currentProvider);
    // console.log(sessionStorage.getItem('web3CUrrentProvider'));
    console.log('Web3 Detected! ' + web3.currentProvider.constructor.name);

    /*  var toAddress = "0x7304e2558269b6380B663fa33bC08B3E366c8F0f";
     var ethAmount = .01; */
    web3.eth.defaultAccount = web3.eth.accounts[0];
    //console.log(web3.eth.defaultAccount);

    var FoodCentralContract = web3.eth.contract([
        {
            "constant": false,
            "inputs": [
                {
                    "name": "_storeName",
                    "type": "string"
                }
            ],
            "name": "addStore",
            "outputs": [],
            "payable": true,
            "stateMutability": "payable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "_storeHash",
                    "type": "bytes32"
                },
                {
                    "name": "_typeOfTrans",
                    "type": "string"
                },
                {
                    "name": "_itemHash",
                    "type": "uint256"
                }
            ],
            "name": "addTransaction",
            "outputs": [
                {
                    "name": "",
                    "type": "bytes32"
                }
            ],
            "payable": true,
            "stateMutability": "payable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "_transactionHash",
                    "type": "bytes32"
                }
            ],
            "name": "confirmDelivery",
            "outputs": [],
            "payable": true,
            "stateMutability": "payable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "_transactionHash",
                    "type": "bytes32"
                }
            ],
            "name": "confirmPayment",
            "outputs": [],
            "payable": true,
            "stateMutability": "payable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "_storeFee",
                    "type": "uint256"
                }
            ],
            "name": "setStoreFee",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "constructor"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "index",
                    "type": "uint256"
                }
            ],
            "name": "getBuyerTransactions",
            "outputs": [
                {
                    "name": "",
                    "type": "bytes32"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "getStoreCount",
            "outputs": [
                {
                    "name": "",
                    "type": "uint256"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "_index",
                    "type": "uint256"
                }
            ],
            "name": "getStoreHashByIndex",
            "outputs": [
                {
                    "name": "",
                    "type": "bytes32"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "_storeHash",
                    "type": "bytes32"
                }
            ],
            "name": "getStoreOwner",
            "outputs": [
                {
                    "name": "",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "_transactionHash",
                    "type": "bytes32"
                }
            ],
            "name": "getTransactionDetails",
            "outputs": [
                {
                    "name": "",
                    "type": "uint256"
                },
                {
                    "name": "",
                    "type": "address"
                },
                {
                    "name": "",
                    "type": "address"
                },
                {
                    "name": "",
                    "type": "bytes32"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "_transactionHash",
                    "type": "bytes32"
                }
            ],
            "name": "getTransactionStatus",
            "outputs": [
                {
                    "name": "",
                    "type": "string"
                },
                {
                    "name": "",
                    "type": "bool"
                },
                {
                    "name": "",
                    "type": "bool"
                },
                {
                    "name": "",
                    "type": "string"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "_transactionHash",
                    "type": "bytes32"
                }
            ],
            "name": "test",
            "outputs": [
                {
                    "name": "",
                    "type": "uint256"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        }
    ]);


    var FoodCentral = FoodCentralContract.at('0xe44ef017c66af7bcf4d72dd938ff258d67ea0b25');

    var storeHashes = new Array();

    //get total store count
    FoodCentral.getStoreCount(function (error, result) {
        if (!error) {
            storeCount = JSON.stringify(result.c[0]);
            getStoreHashesFromContract();
        } else {
            console.error(error);
        }
    });

    //get all store hashes
     function getStoreHashesFromContract() {
       
            console.log(storeCount);
            for (let x = 0; x < storeCount; x++) {

                FoodCentral.getStoreHashByIndex([x], function (error, result) {
                    if (!error) {
                        storeHashes.push((result));
                        console.log('store_hashes ', storeHashes[x]);
                        if(storeCount==x+1){getStores()};
                    } else {
                        console.error(error);
                    }
                });
            }
       

    }


} else {
    // Set the provider you want from Web3.providers
    console.log('please install metamask');
}

