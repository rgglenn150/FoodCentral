<?php $this->load->view('templates/header');?>
    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">Transactions</h1>
        <p class="lead"><?php echo (isset($storeObj) ? $storeObj->store_description : '') ?></p>

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
        function getStores(){};

        function copyStoreAddress() {
            var copyText = document.getElementById("copyStoreAddress");
            copyText.select();
            document.execCommand("copy");
            alert("Copied the text: " + copyText.value);
        }

        function getProductDetails(productID){
            $.ajax(
				{
					type:"POST",
					url: "<?php echo base_url() ?>index.php/product/getProduct/"+productID,
					data:{},
					async:false,
					success:function(response)
					{
						let storeObjects= JSON.parse(response);
						
                        $('span#productName').text(storeObjects.product_name);
                        $('span#transactionType').text('Food Purchase');
                        $('span#price').text(storeObjects.price);
                      //  $('span#productName').text(storeObjects.product_name);
					},
					error: function()
					{
						alert("Invalid!");
					}
				}
			);
        }

        $(document).ready(function(){
            $('button.getProduct').click(function(){
               
                getProductDetails(this.id);
            });

        });

        getTransactions();
      

	</script>


   <?php $this->load->view('templates/footer')?>