<?php $this->load->view('templates/header');?>
    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3"><?php echo (isset($storeObj) ? $storeObj->store_name : '') ?></h1>
        <p class="lead"><?php echo (isset($storeObj) ? $storeObj->store_description : '') ?></p>

      </header>

      <!-- Page Features -->
      <div class="row text-center storeCard">

        <!-- STORE ITEM GOES HERE-->
        <?php
if (!empty($products)) {
    foreach ($products as $product) {
        ?>
            <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                                    <div class="card-body">
                                    <h4 class="card-title"><?php echo $product->product_name ?></h4>
                                    <p class="card-text"><?php echo $product->product_description ?></p>
                                    </div>
                                    <div class="card-footer">
                                    <button type="button" id=<?php echo $product->id ?>  data-toggle="modal" class="btn btn-primary getProduct" data-target="#addTransactionModal">Buy Me!</a>
                                    </div>
                                </div>
                            </div>
                            <?php
}
}
?>
      </div>
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
						console.log(storeObjects.id);
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
                console.log(this.id);
                getProductDetails(this.id);
            });

        });

       

	</script>


   <?php $this->load->view('templates/footer')?>