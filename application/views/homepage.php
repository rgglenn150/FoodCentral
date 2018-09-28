<?php $this->load->view('templates/header');?>
    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">Welcome to Food Central!</h1>
		<p class="lead">Your tummy is our number one priority. Select a store or open your own food business. </p>
		<p>There are currently <span id="totalStoreCount"></span> stores online</p>
        <a href="#" class="btn btn-primary btn-lg">Create your own!</a>
      </header>

      <!-- Page Features -->
      <div class="row text-center storeCard">

        <!-- STORE ITEM GOES HERE-->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->


	<script>

	function getStores(){
			console.log(storeHashes)
			let storeHashArray=JSON.stringify(storeHashes);
			$.ajax(
				{
					type:"POST",
					url: "<?php echo base_url() ?>index.php/store",
					data:{ storeHashes:storeHashArray},
					async:false,
					success:function(response)
					{
						let storeObjects= JSON.parse(response).storeObjects;
						
						
						/* async function processArray(array){
							array.foreach(item=>{
								await func
							});
						} */

						storeObjects.forEach(store =>{
							console.log(store.store_name);
							$('div.storeCard').append(
							'<div class="col-lg-3 col-md-6 mb-4">'+
							'<div class="card">'+
							'	<img class="card-img-top" src="http://placehold.it/500x325" alt="">'+
							'	<div class="card-body">'+
							'	<h4 class="card-title">'+store.store_name+'</h4>'+
							'	<p class="card-text">'+store.store_description+'</p>'+
							'	</div>'+
							'	<div class="card-footer">'+
							'	<a href="<?php echo site_url('store/view/') ;?>'+store.store_hash+'" class="btn btn-primary">Find Out More!</a>'+
							'	</div>'+
							'</div>'+
							'</div>'
							
							);
						});

					},
					error: function()
					{	
						alert("Invalid!");
					}
				}
			);
	};

	</script>


   <?php $this->load->view('templates/footer')?>