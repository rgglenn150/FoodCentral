<?php $this->load->view('templates/header');?>
    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">Transactions</h1>

        <table class="table">
        <thead>
        <tr>
            <th>Transaction Type</th>
            <th>Payment Confirmed</th>
            <th>Delivered</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody class='transactionTable'>


        </tbody>
    </table>
      </header>


      <!-- /.row -->

    </div>
    <!-- /.container -->


    <!-- Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="transactionDetails" style="list-style-type:none" >
                <li name="storeAddress" id="storeAddress"><strong>Store Address: </strong><input id='copyStoreAddress' value=<?php echo $storeObj->store_hash ?>><button onclick="copyStoreAddress()">Copy text</button></li>
                <li id="productName"><strong>Product Name: </strong><span id="productName"></span></li>
                <li id="transactionType"><strong>Transaction Type: </strong><span id="transactionType"></span></li>
                <li id="price"><strong>Price: </strong><span id="price"></span></li>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary saveTransaction">Add Transaction</button>
        </div>
        </div>
    </div>
    </div>


	<script>



       var transactionStatus= new Array();
        function getTransactionStatus(transactionHash=''){

                FoodCentral.getTransactionStatus(transactionHash, function (error, result) {
                    if (!error) {
                        transactionStatus.push(result);
                        
                    } else {
                        console.error(error);
                    }
                });
        }

        function displayTransactionStatus() {
            setTimeout(() => {
            for(let x=0;x<transactions.length;x++){
                getTransactionStatus(transactions[x])
                $('tbody.transactionTable').append('<tr>'+
                '    <td>John</td>'+
                '    <td>Doe</td>'+
                '    <td>john@example.com</td>'+
                '    <td>Doe</td>'+
                '  </tr>');
                
                }
            }, 2000);
            console.log('test2',transactionStatus);
        }

        displayTransactionStatus();

        $(document).ready(function(){
            $('button.getProduct').click(function(){

                getProductDetails(this.id);
            });

        });

        function getStores(){};
        getTransactions();


	</script>


   <?php $this->load->view('templates/footer')?>