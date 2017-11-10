
console.log(window.location.pathname);

if(window.location.pathname== "/" ){

	getDashboardCount();
	// getProduct();
	// getPurchaseProduct();
	// getPurchaseReport();
	// getInventoryValuation();	

}else if(window.location.pathname == "/vendors"){
	getVendor();


}else if(window.location.pathname == "/product"){
	$('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });

	getProductList();
}else if(window.location.pathname == "/choose/product"){
	 $('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });

	 chooseVendorProduct();

}else if(window.location.pathname == "/edit/vendor/product"){
	$('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });

	editVendorProduct();

}else if(window.location.pathname == "/purchase"){
	getPurchaseList();

}else if(window.location.pathname == "/choose/product/purchase"){
	getVendorPurchase();

}else if(window.location.pathname == "/cart/product/purchase"){

	getDataProductVendorPurchase();
}else if(window.location.pathname == "/inventory/comodity"){

	$('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });

	getInventoryComodity();

}else if(window.location.pathname == "/inventory/comodity/item"){

	getInventoryComodityItem();

}else if(window.location.pathname == "/inventory/stock"){

	getDataStockInventory();
}

var urlGeneral = window.location;

$('ul.treeview-menu a').filter(function() {
	 return this.href == urlGeneral;
}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');


///////////////////////////////////////////////PRODUCT/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var listUpdateProduct = {};

function getVendorProduct(){
	$.ajax({
       type:'GET',
       url:'/get/vendor',
       // async: true,
       success:function(data){ 

     //   		  $(document).on(
			  //       'click',
			  //       '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
			  //       function(e) {
			  //           e.preventDefault();
			  //           var tablinks = document.getElementById('dynamic_fields').getElementsByClassName('form-inline');
					// 	// console.log(tablinks.length);

					// 	if(tablinks.length>1){

			  //           	$(this).closest('.form-inline').remove();
					// 	}
			            
			            
			  //       }
			  //   );
			  //   // Add button click
			  //   $(document).on(
			  //       'click',
			  //       '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
			  //       function(e) {
			  //           e.preventDefault();
			  //           var container = $(this).closest('[data-role="dynamic-fields"]');
			  //           new_field_group = container.children().filter('.form-inline:first-child').clone();
			  //           new_field_group.find('input').each(function(){
			  //               $(this).val('');
			  //           });
			  //           container.append(new_field_group);

			            

					// }
			  //   );

 			

 			//get vendor
   //     		console.log(data);
   //     		var result = data;
   //     		var vendorListSelect = document.getElementById('product_vendor');

   //     		for (var i = 0; i<result.data.length; i++){
			//     var opt = document.createElement('option');
			//     opt.value = result.data[i].id+"_"+result.data[i].name;
			//     opt.innerHTML = result.data[i].name;
			//     vendorListSelect.appendChild(opt);
			// }
       }
    })
}

function getProductList(){

	$.ajax({
       type:'GET',
       url:'/get/product',
       // async: true,
       success:function(data){

			console.log(data);
			var result = data;

			// var arrVendorName = [];
			// var arrVendorPrice = [];

			var htmlEmptyProduct = '<div class="row">'+
					            '<div class="col-sm-12">'+
					                '<div class="panel panel-default">'+
					    
					            '<div class="panel-body" style="height: 30vh;padding-top: 10vh;">'+
					            '<div class="text-center"><h4><b>Komoditas Kosong</b></h4></div>'+
					        '</div>'+
					    
					    '</div>'+

			            '</div>'+
        			'</div>'

        	if(result.data.length > 0){


        		for (var i = 0; i < result.data.length; i++) {

					// for (var j = 0; j < result.data[i].vendor.length; j++) {
					// 	for (var k = 0; k < result.data[i].vendor[j].length; k++) {
					// 		var rep = result.data[i].vendor[j][k].name[1].replace(" ","_")+"/"+result.data[i].vendor[j][k].name[0];
					// 		arrVendorName.push(rep);
					// 		arrVendorPrice.push(result.data[i].vendor[j][k].price);
					// 	}                

					// }

					var cardHtml =  

									// '<div class="col-sm-2 card-product">'+
	        //                                '<div class="thumbnail">'+
	        //                                     '<img class="card-img-top" style="width: 100%;" src="data:image/jpeg;base64,'+result.data[i].image_medium+'" alt="Card image cap">'+
	        //                          				'<div class="caption">'+
	        //                                          '<p class="card-text" style="text-align:center;font-weight: bold;">'+result.data[i].name+'</p>'+
	        //                                          '<p class="card-text" style="text-align:center;margin-top: -10px;">'+result.data[i].x_kategori_produk+'</p>'+

	        //                                         // '<button class="btn btn-default btn-xs pull-right edit-product" data-id="'+result.data[i].id+'" data-name="'+result.data[i].name+'" data-kategori="'+result.data[i].x_kategori_produk+'" data-plant="'+result.data[i].x_tanggal_awal_tanam+" - "+result.data[i].x_tanggal_akhir_tanam+'" data-harvest="'+result.data[i].x_tanggal_awal_panen+" - "+result.data[i].x_tanggal_akhir_panen+'" data-vendor='+JSON.stringify(arrVendorName)+' data-price='+JSON.stringify(arrVendorPrice)+' role="button"><i class="glyphicon glyphicon-edit"></i>Edit</button>  <button href="#" data-id="'+result.data[i].id+'" data-vendor='+JSON.stringify(arrVendorName)+' class="btn btn-default btn-xs delete-product" role="button"><i class="glyphicon glyphicon-trash"></i>Delete</button>'+
	        //                                         '<div class="btn-group">'+
									// 				  '<button type="button" href="#" data-id="'+result.data[i].id+'" class="btn btn-danger btn-xs delete-product" ><i class="glyphicon glyphicon-trash"></i> Delete</button>'+
									// 				  '<button type="button" class="btn btn-success btn-xs edit-product" data-id="'+result.data[i].id+'" data-imagemedium="'+result.data[i].image_medium+'" data-image="'+result.data[i].image+'" data-name="'+result.data[i].name+'" data-category="'+result.data[i].x_kategori_produk+'"><i class="glyphicon glyphicon-edit"></i> Edit</button>'+
													  
									// 				'</div>'+
	        //                                     '</div>'+
	        //                                 '</div>'+
	        //                             '</div>';

	                                    '<div class="items col-sm-2 item-product">'+
                                            '<div class="info-block block-info clearfix">'+
                                                
                                                '<div data-toggle="buttons"  class="btn-group bizmoduleselect">'+
                                                    
                                                	'<label class="btn btn-default product-label" id="product_label_'+result.data[i].id+'" style="padding: 0;">'+
                                              		   
                                              		   '<div id="panel_action_comodity"style="position: absolute;color:wheat;font-size: 15px;background: rgb(56, 86, 107);width:100%;"><i style="margin-right:80px;" class="glyphicon glyphicon-edit edit-product" data-id="'+result.data[i].id+'" data-imagemedium="'+result.data[i].image_medium+'" data-image="'+result.data[i].image+'" data-name="'+result.data[i].name+'" data-category="'+result.data[i].x_kategori_produk+'"></i><i class="glyphicon glyphicon-trash delete-product" data-id="'+result.data[i].id+'"></i></div>'+
                                                         
                                                       '<img style="width: 100%;" src="data:image/jpeg;base64,'+result.data[i].image_medium+'">'+
                                             			 '<div class="bizcontent">'+
                                                            '<h5 style="font-weight:bold;">'+result.data[i].name+'</h5>'+
                                                            '<h5>'+result.data[i].x_kategori_produk+'</h5>'+
                                                            '<input id="card_'+result.data[i].id+'" class="product-item" data-id="'+result.data[i].id+'" style="display:none;" >'+
                                                            
                                                        '</div>'+
                                                
                                                    '</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';

	                $('#product_card_row').append(cardHtml);
	                
	                // arrVendorName = [];
	                // arrVendorPrice = [];
				}


        	}else{
        		$('#product_card_row').html(htmlEmptyProduct);
        	}

			
			 //change image preview
			document.getElementById("product_file_image_create").onchange = function () {
			    var reader = new FileReader();

			    reader.onload = function (e) {
			        // get loaded data and render thumbnail.
			        document.getElementById("product_image_create").src = e.target.result;
			        document.getElementById("product_image_create").style.width = '23%';
			    };

			    // read the image file as a data URL.
			    reader.readAsDataURL(this.files[0]);
			};


			$('.edit-product').click(function(){

				var id = $(this).data('id');
				var name = $(this).data('name');
				var category = $(this).data('category');
				var imageMedium = $(this).data('imagemedium');
				var image = $(this).data('image');

				console.log(category);

				if(category != "cherry" && category != "green beans"){
					console.log('test');
					$('#product_category_update').val('lainnya');
					$('#other_category_update').css('display','block');  
					document.getElementById("other_category_update").value = category;

				}else{
					$('#other_category_update').css('display','none');  
					document.getElementById("other_category_update").value = "";
					$('#product_category_update').val(category);
				}

				document.getElementById("product_name").value = name;

				//set image
				document.getElementById("product_image").src="data:image/jpeg;base64,"+imageMedium;

				//change image preview
				document.getElementById("product_file_image").onchange = function () {
				    var reader = new FileReader();

				    reader.onload = function (e) {
				        // get loaded data and render thumbnail.
				        document.getElementById("product_image").src = e.target.result;
				        document.getElementById("product_image").style.width = '23%';
				        console.log('test');

					    var imgSplit = document.getElementById("product_image").src.split(",/");
						$('#updateProduct').attr('data-image', "/"+imgSplit[1]);
				    };
				    

				    // read the image file as a data URL.
				    reader.readAsDataURL(this.files[0]);
				};

				if(document.getElementById("product_file_image").value==""){
					console.log('test2');
					$('#updateProduct').attr('data-image', image);
				}
					
				

				$('#updateProduct').attr('data-id', id);
				
				$("#updateProductModal").modal();

				// listUpdateProduct = {
				// 	id : id,
				// 	name : name,
				// 	kategori : kategori,
				// 	plant : plant,
				// 	harvest : harvest,
				// 	vendor : vendor,
				// 	price : price
				// }

				// console.log(listUpdateProduct);

				// window.location.href="/update/product?data="+JSON.stringify(listUpdateProduct);
			})

 			$('#updateProduct').unbind('click').click(function(){

 				// console.log($(this).data('image'));

 				var category = $('#product_category_update').val();

 				if(category != "cherry" && category != "green beans"){
 					category = document.getElementById("other_category_update").value;
 				}

 				var dataSend = {
			         id : $(this).data('id'),
			         name : document.getElementById("product_name").value,
			         category : category,
			         image : $(this).data('image')
			      }

			      console.log(dataSend);

				$.ajax({
			          type: "POST",
			          url: "/update/product",
			          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
			          // The key needs to match your method's input parameter (case-sensitive).
			          data: JSON.stringify(dataSend),
			          contentType: "application/json; charset=utf-8",
			          dataType: "json",
			          success: function(data){

			            console.log(data);
			            location.reload();
			            
			          },
			          failure: function(errMsg) {
			              alert(errMsg);
			          }
			      });

 			})

			var idDeleteProduct = "";

			$('.delete-product').unbind('click').click(function(){

				idDeleteProduct = $(this).data('id');

				// console.log(idDeleteProduct);
			
				$("#confirm-delete-product").modal();

				
			})

			$('#confirmDeleteProduct').on('click', function(e) {
					
					// var id = $(this).data('id');
					console.log(idDeleteProduct);

				   var dataSend = {
				         id : idDeleteProduct
				    }

				   $.ajax({
				          type: "POST",
				          url: "/delete/product",
				          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
				          // The key needs to match your method's input parameter (case-sensitive).
				          data: JSON.stringify(dataSend),
				          contentType: "application/json; charset=utf-8",
				          dataType: "json",
				          success: function(data){

				            console.log(data);

				            $("#confirm-delete-product").modal('hide');

				            location.reload();
				            
				          },
				          failure: function(errMsg) {
				              alert(errMsg);
				          }
				      });
  
				});
			


       }
    });

}

 $('#product_category_update').change(function() {
        var selectedValue = $(this).val();

        console.log('test');
        if(selectedValue  === 'lainnya') {
            $('#other_category_update').css('display','block');    
        }else{
        	$('#other_category_update').css('display','none');
        } 
    });

 $('#product_category_create').change(function() {
        var selectedValue = $(this).val();

        if(selectedValue  === 'lainnya') {
            $('#other_category').css('display','block');    
        }else{
        	$('#other_category').css('display','none');
        } 
    });

//GET DATA PARAMETER URL LINK GET
function updateProduct(){
	 console.log(JSON.parse(getParameterByName('data')));
}



function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}





////////////////////////////////////////////////VENDOR////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function getVendor(){
	$(document).ready(function() {
	    $('#dataTables-example').DataTable({
	        responsive : true,
	        ajax : {
	            "url" : "/get/vendor"
	        },
	        columns : [ {
	            "data" : "name"
	        }, {
	        	"data" : "x_farm_name"
	        }, {
	            "data" : "phone"
	        }, {
	            "data" : "street"
	        }, {
	        	"data" : "action", "orderable": false, "searchable": false
	        }]
	    });


	});

	$('#dataTables-example').on('click', '.edit-vendor', function(){
	   var id = $(this).data('id');
	   var name = $(this).data('name');
	   var address = $(this).data('address');
	   var phone = $(this).data('phone');
	   var email = $(this).data('email');
	   var group = $(this).data('group');
	   var farm = $(this).data('farm');
	   var area = $(this).data('area');
	   console.log(email);

	   document.getElementById('update_vendor_name').value = name;
	   document.getElementById('update_vendor_address').value = address;
	   document.getElementById('update_vendor_phone').value = phone;
	   document.getElementById('update_vendor_email').value = email;
	   document.getElementById('update_vendor_farm').value = farm;
	   document.getElementById('update_vendor_area').value = area;
	   $('#update_vendor_group').val(group);

	   $('#updateVendor').attr('data-id', id);
	   $('#updateVendor').attr('data-name', name);
	   $('#updateVendor').attr('data-address', address);
	   $('#updateVendor').attr('data-phone', phone);
	   $('#updateVendor').attr('data-email', email);
	   $('#updateVendor').attr('data-farm', farm);
	   $('#updateVendor').attr('data-group', group);
	   $('#updateVendor').attr('data-area', area);

	   $("#updateVendorModal").modal();
	});

	$('#updateVendor').on('click',function(){

		var id = $(this).data('id');
		var name = document.getElementById('update_vendor_name').value;
		var address = document.getElementById('update_vendor_address').value;
		var phone = document.getElementById('update_vendor_phone').value;
		var email = document.getElementById('update_vendor_email').value;
		var farm = document.getElementById('update_vendor_farm').value;
		var area = document.getElementById('update_vendor_area').value;
		var group = $('#update_vendor_group').val();

		var dataSend = {
	         id : id,
	         name : name,
	         address : address,
	         phone : phone,
	         email : email,
	         farm : farm,
	         group : group,
	         area : area
	      }

		$.ajax({
	          type: "POST",
	          url: "/update/vendor",
	          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
	          // The key needs to match your method's input parameter (case-sensitive).
	          data: JSON.stringify(dataSend),
	          contentType: "application/json; charset=utf-8",
	          dataType: "json",
	          success: function(data){

	            console.log(data);
	            location.reload();
	            
	          },
	          failure: function(errMsg) {
	              alert(errMsg);
	          }
	      });

		console.log(id);
	})

 	$('#dataTables-example').on('click', '.delete-vendor', function(){
	   var id = $(this).data('id');
	   
	   console.log(id);

	   var dataSend = {
	         id : id
	    }

	   $.ajax({
	          type: "POST",
	          url: "/delete/vendor",
	          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
	          // The key needs to match your method's input parameter (case-sensitive).
	          data: JSON.stringify(dataSend),
	          contentType: "application/json; charset=utf-8",
	          dataType: "json",
	          success: function(data){

	            console.log(data);
	            location.reload();
	            
	          },
	          failure: function(errMsg) {
	              alert(errMsg);
	          }
	      });

	});

	$('#dataTables-example').on('click', '.product-vendor', function(){
	 
		 var id = $(this).data('id');
		 var name = $(this).data('name');
		 console.log(id);

		 window.location.href="/edit/vendor/product?vendor_id="+id+"&vendor_name="+name;

	 })	

	$.ajax({
		type:'GET',
		url:'/get/vendor',
		// async: true,

		success:function(data){

			console.log(data);

		}
	})
}

///////////////////////////////////////////////////VENDOR PRODUCT//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function editVendorProduct(){

	var name = "Komoditas Petani "+JSON.stringify(getParameterByName('vendor_name')).replace(/['"]+/g, '');
	console.log(name);
	$('.page-header-custom').text(name);

	 var dataSend = {
        vendorId  : JSON.parse(getParameterByName('vendor_id'))
    }

    var htmlEmpty = '<div class="row">'+
					            '<div class="col-sm-12">'+
					                '<div class="panel panel-default">'+
					    
					            '<div class="panel-body" style="height: 30vh;padding-top: 10vh;">'+
					            '<div class="text-center"><h4><b>Komoditas Kosong</b></h4></div>'+
					        '</div>'+
					    
					    '</div>'+

			            '</div>'+
        			'</div>'

	    console.log(dataSend);

	   $.ajax({
	          type: "POST",
	          url: "/get/product/vendor",
	          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
	          // The key needs to match your method's input parameter (case-sensitive).
	          data: JSON.stringify(dataSend),
	          contentType: "application/json; charset=utf-8",
	          dataType: "json",
	          success: function(data){

	          	console.log(data);

	          	var result = data;

	          	var arrProductVendorId = [];
	          	var arrProductId = [];
	          	var plant = "";
	          	var harvest = "";

	          	if(result.data.length>0){
	          		for (var i = 0; i < result.data.length; i++) {

	          			arrProductVendorId.push(result.data[i].id);
	          			arrProductId.push(result.data[i].product_detail[0].id)
	 					
	 					// if(result.data[i].x_tanggal_awal_tanam!=false){
	 					// 	var plantStart = result.data[i].x_tanggal_awal_tanam.split("-");
			    //       		var plantFinish = result.data[i].x_tanggal_akhir_tanam.split("-");
			    //       		plant = plantStart[1]+"-"+plantStart[2]+"-"+plantStart[0]+" - "+plantFinish[1]+"-"+plantFinish[2]+"-"+plantFinish[0];
		          		
	 					// }

	 					// if(result.data[i].x_tanggal_awal_tanam!=false){
	 					// 	var harvestStart = result.data[i].x_tanggal_awal_panen.split("-");
			    //       		var harvestFinish = result.data[i].x_tanggal_akhir_panen.split("-");
			    //       		harvest = harvestStart[1]+"-"+harvestStart[2]+"-"+harvestStart[0]+" - "+harvestFinish[1]+"-"+harvestFinish[2]+"-"+harvestFinish[0];

	 					// }
		          		
		          		var cardVendorProductHtml = 

		          				// 					 '<div class="col-sm-2 card-product-vendor">'+
				            //                            '<div class="thumbnail">'+
				            //                                 '<img class="card-img-top" style="width: 100%;" src="data:image/jpeg;base64,'+result.data[i].product_detail[0].image_medium+'" alt="Card image cap">'+
				            //                      				'<div class="caption">'+
				            //                                      '<p class="card-text" style="text-align:center;font-weight: bold;">'+result.data[i].product_detail[0].name+'</p>'+
				            //                                      '<p class="card-text" style="text-align:center;margin-top: -10px;">'+result.data[i].product_detail[0].x_kategori_produk+'</p>'+

				            //                                     // '<button class="btn btn-default btn-xs pull-right edit-product" data-id="'+result.data[i].id+'" data-name="'+result.data[i].name+'" data-kategori="'+result.data[i].x_kategori_produk+'" data-plant="'+result.data[i].x_tanggal_awal_tanam+" - "+result.data[i].x_tanggal_akhir_tanam+'" data-harvest="'+result.data[i].x_tanggal_awal_panen+" - "+result.data[i].x_tanggal_akhir_panen+'" data-vendor='+JSON.stringify(arrVendorName)+' data-price='+JSON.stringify(arrVendorPrice)+' role="button"><i class="glyphicon glyphicon-edit"></i>Edit</button>  <button href="#" data-id="'+result.data[i].id+'" data-vendor='+JSON.stringify(arrVendorName)+' class="btn btn-default btn-xs delete-product" role="button"><i class="glyphicon glyphicon-trash"></i>Delete</button>'+
				            //                                     '<div class="btn-group">'+
																//   '<button type="button" href="#" data-id="'+result.data[i].id+'" class="btn btn-danger btn-xs delete-vendor-product" ><i class="glyphicon glyphicon-trash"></i> Delete</button>'+
																//   '<button type="button" class="btn btn-success btn-xs edit-vendor-product" data-id="'+result.data[i].id+'" data-price="'+result.data[i].price+'" data-origin="'+result.data[i].x_product_origin+'" data-plant="'+plant+'" data-harvest="'+harvest+'"><i class="glyphicon glyphicon-edit"></i> Edit</button>'+
																  
																// '</div>'+
				            //                                 '</div>'+
				            //                             '</div>'+
				            //                         '</div>';

				                               		'<div class="items col-sm-2 item-product-vendor">'+
			                                            '<div class="info-block block-info clearfix">'+
			                                                
			                                                '<div data-toggle="buttons"  class="btn-group bizmoduleselect">'+
			                                                    
			                                                	'<label class="btn btn-default product-vendor-label" id="product_vendor_label_'+result.data[i].id+'" style="padding: 0;">'+
			                                              		   
			                                              		   '<div id="panel_action_vendor_comodity"style="position: absolute;color:wheat;font-size: 15px;background: rgb(56, 86, 107);width:100%;"><i style="margin-right:80px;" class="glyphicon glyphicon-edit edit-vendor-product" data-id="'+result.data[i].id+'" data-price="'+result.data[i].price+'" data-origin="'+result.data[i].x_product_origin+'" data-plant="'+plant+'" data-harvest="'+harvest+'"></i><i class="glyphicon glyphicon-trash delete-vendor-product" data-supplierid="'+result.data[i].name[0]+'" data-supplierproduct="'+result.data[0].id+'" data-product="'+result.data[i].product_tmpl_id[0]+'"></i></div>'+
			                                                         
			                                                       '<img style="width: 100%;" src="data:image/jpeg;base64,'+result.data[i].product_detail[0].image_medium+'">'+
			                                             			 '<div class="bizcontent">'+
			                                                            '<h5 style="font-weight:bold;">'+result.data[i].product_detail[0].name+'</h5>'+
			                                                            '<h5>'+result.data[i].product_detail[0].x_kategori_produk+'</h5>'+
			                                                            '<input id="card_'+result.data[i].id+'" class="product-vendor-item" data-id="'+result.data[i].id+'" style="display:none;" >'+
			                                                            
			                                                        '</div>'+
			                                                
			                                                    '</label>'+
			                                                '</div>'+
			                                            '</div>'+
			                                        '</div>';

	                	$('#vendor_product_card_row').append(cardVendorProductHtml);
		          	}


		          }else{
		          		$('#vendor_product_card_row').html(htmlEmpty);
		          }
	          	

	          	datePickerEvent();

	          	$('.add-vendor-product').click(function(){
	          		var vendorId = JSON.parse(getParameterByName('vendor_id'));
	          		var vendorName = JSON.stringify(getParameterByName('vendor_name')).replace(/['"]+/g, '');
	          		console.log(vendorName);
	          		window.location.href = "/choose/product?vendor_id="+vendorId+"&vendor_name="+vendorName+"&vendor_product="+JSON.stringify(arrProductVendorId)+"&product="+JSON.stringify(arrProductId);
	          	})

	          	$('.edit-vendor-product').click(function(){

	          		var id = $(this).data('id');
	          		var price = $(this).data('price');
	          		var origin = $(this).data('origin');
	          		var plant = $(this).data('plant');
	          		var harvest = $(this).data('harvest');

	          		console.log(origin);

	          		document.getElementById("product_vendor_price").value = price;
	          		document.getElementById("product_vendor_origin").value = origin;
	          		document.getElementById("product_vendor_plant").value = plant;
	          		document.getElementById("product_vendor_harvest").value = harvest;

	          		$('#updateVendorProduct').attr('data-id', id);
	          		$('#updateVendorProduct').attr('data-price', price);
	          		$('#updateVendorProduct').attr('data-origin', origin);
	          		$('#updateVendorProduct').attr('data-plant', plant);
	          		$('#updateVendorProduct').attr('data-harvest', harvest);

	          		$('#updateProductVendorModal').modal();
	          	})

	          	$('#updateVendorProduct').click(function(){

	          		var id = $(this).data('id');

	          		var dataSend = {
	          			id : id,
	          			price : document.getElementById("product_vendor_price").value,
	          			origin : document.getElementById("product_vendor_origin").value,
	          			plant : document.getElementById("product_vendor_plant").value,
	          			harvest : document.getElementById("product_vendor_harvest").value
	          		}

	          		console.log(dataSend);

	          		 $.ajax({
				          type: "POST",
				          url: "/update/product/vendor",
				          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
				          // The key needs to match your method's input parameter (case-sensitive).
				          data: JSON.stringify(dataSend),
				          contentType: "application/json; charset=utf-8",
				          dataType: "json",
				          success: function(data){

				          	console.log(data);
	            			location.reload();
				          }
				     })

	          	})

				var idDeleteVendorSupp = "";
				var idDeleteVendorProductSupp = "";
				var idDeleteVendorProduct = "";

	          	$('.delete-vendor-product').click(function(){
	          		idDeleteVendorSupp = $(this).data('supplierid');
	          		idDeleteVendorProductSupp = $(this).data('supplierproduct');
	          		idDeleteVendorProduct = $(this).data('product');
	          	
				    $("#confirm-delete-product-vendor").modal();

				    
	          	})

				$('#confirmDeleteProductVendor').click(function(){

					var dataSend = {
				         supplier_id : idDeleteVendorSupp,
				         supplier_product : idDeleteVendorProductSupp,
				         product_id : idDeleteVendorProduct
				    }

				    console.log(dataSend);

				   $.ajax({
				          type: "POST",
				          url: "/delete/product/vendor",
				          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
				          // The key needs to match your method's input parameter (case-sensitive).
				          data: JSON.stringify(dataSend),
				          contentType: "application/json; charset=utf-8",
				          dataType: "json",
				          success: function(data){

				 
								console.log(data);	
								$("#confirm-delete-product-vendor").modal('hide');

								location.reload();
				            
				          },
				          failure: function(errMsg) {
				              alert(errMsg);
				          }
				      });

				})

	          }
	    })

}

function datePickerEvent(){
	// //datepicker range
		 //  	$('input[name="product_vendor_plant"]').daterangepicker({
		 //  		 opens: "center",
		 //  		 autoUpdateInput: false,
			//       locale: {
			//           cancelLabel: 'Clear'
			//       }
		 //  	});

		 //  	$('input[name="product_vendor_plant"]').on('apply.daterangepicker', function(ev, picker) {
			//       $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			//   });

			//   $('input[name="product_vendor_plant"]').on('cancel.daterangepicker', function(ev, picker) {
			//       $(this).val('');
			//   });

			// $('input[name="product_vendor_harvest"]').daterangepicker({
			// 	opens: "center",
		 //  		 autoUpdateInput: false,
			//       locale: {
			//           cancelLabel: 'Clear'
			//       }
			// });

			// $('input[name="product_vendor_harvest"]').on('apply.daterangepicker', function(ev, picker) {
			//       $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			//   });

			//  $('input[name="product_vendor_harvest"]').on('cancel.daterangepicker', function(ev, picker) {
			//       $(this).val('');
			//  });
}


function chooseVendorProduct(){

	var name = "Pilih Komoditas Petani "+JSON.stringify(getParameterByName('vendor_name')).replace(/['"]+/g, '');
	console.log(name);
	$('.page-header-custom').text(name);

	$.ajax({
       type:'GET',
       url:'/get/product',
       // async: true,
       success:function(data){

			console.log(data);
			var result = data;

			console.log(JSON.parse(getParameterByName('vendor_id')));

			var vendorProduct = JSON.parse(getParameterByName('vendor_product'));
			console.log(vendorProduct);

			var productList = JSON.parse(getParameterByName('product'));
			console.log(productList);

			var productVendorHtml = "";
			var productResultId = [];
			var productNotSame = [];

			for (var i = 0; i < result.data.length; i++) {
				productResultId.push(result.data[i].id);
			}

			jQuery.grep(productResultId, function(el) {
			      if (jQuery.inArray(el, productList) == -1) productNotSame.push(el);
			});

			console.log(productNotSame);

			var htmlEmptyProductPurchaseVendor = '<div class="row">'+
					            '<div class="col-sm-12">'+
					                '<div class="panel panel-default">'+
					    
					            '<div class="panel-body" style="height: 30vh;padding-top: 8vh;">'+
					            '<div class="text-center"><h4><b>Semua Komoditas Petani Telah Dipilih</b></h4></div>'+
					            '<div class="text-center"><button class="btn btn-success" id="addNewComodityChooseVendorNotSame"><i class="glyphicon glyphicon-plus"></i> Tambah Komoditas Baru</button></div>'+
					        '</div>'+
					    
					    '</div>'+

			            '</div>'+
        			'</div>'

			if(productNotSame.length==0){

				$('#product_vendor_container').html(htmlEmptyProductPurchaseVendor);

				$('#addNewComodityChooseVendorNotSame').click(function(){
					window.location.href="/product";
				})

			}else{

				$('#panel_action_comodity').css('display','block');

				$('#addNewComodityChooseVendor').click(function(){
					window.location.href="/product";
				})

				for (var j = 0;  j< result.data.length; j++) {

					for (var k = 0; k < productNotSame.length; k++) {
						if(result.data[j].id == productNotSame[k]){
							productVendorHtml =  '<div class="items col-sm-2 item-product-vendor" data-id="'+result.data[j].id+'">'+
                                            '<div class="info-block block-info clearfix">'+
                                                
                                                '<div data-toggle="buttons"  class="btn-group bizmoduleselect">'+
                                                    
                                                	'<label class="btn btn-default product-vendor-label" id="product_vendor_label_'+result.data[j].id+'" style="padding: 0;">'+
                                              		   
                                              		   '<div id="check_image_comodity"style="display:none;position: absolute;font-size: 20px;background: rgb(56, 86, 107);width:100%;"><i class="glyphicon glyphicon-ok"></i></div>'+
                                                         
                                                       '<img style="width: 100%;" src="data:image/jpeg;base64,'+result.data[j].image_medium+'">'+
                                             			 '<div class="bizcontent">'+
                                                            '<h5 style="font-weight:bold;">'+result.data[j].name+'</h5>'+
                                                            '<h5>'+result.data[j].x_kategori_produk+'</h5>'+
                                                            '<input type="checkbox" id="checkbox_'+result.data[j].id+'" class="vendor-product-checkbox" data-id="'+result.data[j].id+'" style="display:none;" >'+
                                                            
                                                        '</div>'+
                                                
                                                    '</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';

                        	$('#product_vendor_container').append(productVendorHtml);

						}
						
					}
					
				}

			}

           
       //      			$('#checkbox_'+result.data[k].id).attr('data-productvendor', vendorProduct[j]);
       //      			$('#product_vendor_label_'+result.data[k].id).addClass("active");
	 					// $('#checkbox_'+result.data[k].id).prop('checked', true);
	 					


			datePickerEvent();

			$('#nextProductVendor').click(function(){
				
				var vendorId = JSON.parse(getParameterByName('vendor_id'));
          		var vendorName = JSON.stringify(getParameterByName('vendor_name')).replace(/['"]+/g, '');
          		window.location.href = "/edit/vendor/product?vendor_id="+vendorId+"&vendor_name="+vendorName;
	          
			})


			 $('.vendor-product-checkbox').change(function() {
			 	var productId = $(this).data('id');

		        if($(this).is(':checked')){

		        	// console.log(productId);

		        	$('#check_image_comodity').css('display','block');

		            $("#productVendorModal").modal({backdrop: 'static', keyboard: false});

		            $('#submitProductVendor').unbind('click').click(function(){
				
						var vendorId = JSON.parse(getParameterByName('vendor_id'));
						var price = document.getElementById("product_vendor_price").value;
						var plant = document.getElementById("product_vendor_plant").value;
						var harvest = document.getElementById("product_vendor_harvest").value;
						var origin = document.getElementById("product_vendor_origin").value;

						console.log(vendorId);

						var dataSend = {
					        productId  : productId,
					        vendorId : vendorId,
					        price : price,
					        plant : plant,
					        harvest : harvest,
					        origin : origin
					    }

					    console.log(dataSend);

					   $.ajax({
					          type: "POST",
					          url: "/add/product/vendor",
					          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					          // The key needs to match your method's input parameter (case-sensitive).
					          data: JSON.stringify(dataSend),
					          contentType: "application/json; charset=utf-8",
					          dataType: "json",
					          success: function(data){

					          	$("#productVendorModal").modal('hide');
					          	document.getElementById("product_vendor_price").value = "";
					          	document.getElementById("product_vendor_plant").value = "";
					          	document.getElementById("product_vendor_harvest").value = "";
					          	document.getElementById("product_vendor_origin").value = "";

					          	$('#submitProductVendor').removeAttr('disabled');

					          	$("#body_success").text("Komoditas Petani Berhasil Ditambahkan");

					          	$("#productVendorModalSuccess").modal();
					            console.log(data);

					            var result = data;
					            console.log(result.data);

					             $('#checkbox_'+productId).attr('data-productvendor', result.data);
					             $('#checkbox_'+productId).attr('data-productid', productId);
					             $('#checkbox_'+productId).attr('data-vendorid', vendorId);
					            // location.reload();
					            
					          },
					          failure: function(errMsg) {
					              alert(errMsg);
					          }
					      });


					})

		 			$('#cancelProductVendor').unbind('click').click(function(){
		 				
		 				// console.log(productId);

		 				$('#product_vendor_label_'+productId).removeClass("active");
		 				$('#checkbox_'+productId).prop('checked', false);

		 				$('#check_image_comodity').css('display','none');
		 			})
		            
		        }else{

		        	console.log('unchecked');

		        	$('#check_image_comodity').css('display','none');

		        	//delete vendor product
		        	var productVendor = $(this).data('productvendor');
		        	var productId = $(this).data('productid');
		        	var vendorId = $(this).data('vendorid');

		        	if(productVendor!=undefined){

					   var dataSend = {
					         supplier_id : vendorId,
					         supplier_product : productVendor,
					         product_id : productId
					    }

					    console.log(dataSend);

					   $.ajax({
					          type: "POST",
					          url: "/delete/product/vendor/choose",
					          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					          // The key needs to match your method's input parameter (case-sensitive).
					          data: JSON.stringify(dataSend),
					          contentType: "application/json; charset=utf-8",
					          dataType: "json",
					          success: function(data){

					            console.log(data);
					            $("#body_success").text("Komoditas Petani Berhasil Dihapus");

								$("#productVendorModalSuccess").modal();
					            // location.reload();
					            
					          },
					          failure: function(errMsg) {
					              alert(errMsg);
					          }
					      });
		        	}
		 			

		        }

		    });


		}
	})


}

//////////////////////////////////////////////////////PURCHASE////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function getPurchaseList(){
	$(document).ready(function() {
	    $('#dataTables-purchase').DataTable({
	        responsive : true,
	        ajax : {
	            "url" : "/get/purchase/order"
	        },
	        columns : [ {
	            "data" : "name"
	        }, {
	        	"data" : "date_order"
	        }, {
	            "data" : "vendor_name"
	        }, {
	            "data" : "amount_total"
	        }, {
	            "data" : "purchase_status"
	        }]
	    });


	});

	$('.add-product-purchase').click(function(){
  		window.location.href = "/choose/product/purchase";
  	})

 	$.ajax({
		type:'GET',
		url:'/get/purchase/order',
		// async: true,

		success:function(data){

			console.log(data);

		}
	})

}

function getVendorPurchase(){
	$.ajax({
       type:'GET',
       url:'/get/vendor',
       // async: true,
       success:function(data){ 		

 			//get vendor
       		console.log(data);
       		var result = data;
       		var vendorListSelect = document.getElementById('vendor_purchase');

       		$('#vendor_purchase').val(result.data[0].id);

       		console.log(result.data[0].id);

			$.LoadingOverlay("show");

       		//get product purchase by vendor id
       		getProductVendorPurchase(result.data[0].id);

       		for (var i = 0; i<result.data.length; i++){
			    var opt = document.createElement('option');
			    opt.value = result.data[i].id;
			    opt.innerHTML = result.data[i].name;
			    vendorListSelect.appendChild(opt);
			}

       		$('#vendor_purchase').on('change', function() {
			    console.log( this.value );
			    
			    $.LoadingOverlay("show");
			    document.getElementById("badge_purchase_cart").innerHTML = 0;

			 	getProductVendorPurchase(this.value);

			})

			

       }
    })
}

function getProductVendorPurchase(id){
	 var dataSend = {
         vendorId : id
     }

	var arrProduct = [];

    $('#product_vendor_purchase').html("");

	  $.ajax({
          type: "POST",
          url: "/get/product/vendor",
          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify(dataSend),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){

          		$.LoadingOverlay("hide");

				console.log(data);

				var result = data;

				if(result.data.length==0){

					var htmlEmptyProductPurchaseVendor = '<div class="row">'+
					            '<div class="col-sm-12">'+
					                '<div class="panel panel-default">'+
					    
					            '<div class="panel-body" style="height: 30vh;padding-top: 10vh;">'+
					            '<div class="text-center"><h4><b>Komoditas Kosong</b></h4></div>'+
					        '</div>'+
					    
					    '</div>'+

			            '</div>'+
        			'</div>'
        			$('#product_vendor_purchase').html(htmlEmptyProductPurchaseVendor);

				}else{
					for (var i = 0; i < result.data.length; i++) {

						var productVendorHtml =  '<div class="items col-sm-2 item-product-vendor-purchase" data-id="'+result.data[i].id+'">'+
			                                        '<div class="info-block block-info clearfix">'+
			                                            
			                                            '<div data-toggle="buttons"  class="btn-group bizmoduleselect">'+
			                                                
			                                                '<label class="btn btn-default" id="product_vendor_purchase_label_'+result.data[i].product_detail[0].id+'" style="padding: 0;">'+

			                                                   '<img style="width: 100%;" src="data:image/jpeg;base64,'+result.data[i].product_detail[0].image_medium+'">'+
			                                         
			                                                     '<div class="bizcontent">'+
			                                                        '<h5 style="font-weight:bold;">'+result.data[i].product_detail[0].name+'</h5>'+
			                                                        '<h5>'+result.data[i].product_detail[0].x_kategori_produk+'</h5>'+
			                                                        '<input type="checkbox" id="checkbox_product_purchase_'+result.data[i].product_detail[0].id+'" class="vendor-product-purchase-checkbox" data-vendorname="'+result.data[i].name+'" data-supplierid="'+result.data[i].id+'" data-id="'+result.data[i].product_detail[0].id+'" data-partner="'+result.data[i].id+'" data-name="'+result.data[i].product_detail[0].name+'" data-image="'+result.data[i].product_detail[0].image_medium+'" data-price="'+result.data[i].price+'" style="display:none;" >'+
			                                                        
			                                                    '</div>'+
			                                                '</label>'+
			                                            '</div>'+
			                                        '</div>'+
			                                    '</div>';

			            $('#product_vendor_purchase').append(productVendorHtml);
					}
				}

				

				$('.vendor-product-purchase-checkbox').change(function() {
			 	var productId = $(this).data('id');
			 	var partnerId = $(this).data('partner');
			 	var supplierId = $(this).data('supplierid');
			 	var partnerName = $(this).data('vendorname');
			 	var name = $(this).data('name');
			 	var image = $(this).data('image');
			 	var price = $(this).data('price');

		        if($(this).is(':checked')){


		            $("#productVendorPurchaseModal").modal({backdrop: 'static', keyboard: false});

		            //RATING
		            var stars = $('#stars li').parent().children('li.star');
    
				    for (i = 0; i < stars.length; i++) {
				      $(stars[i]).removeClass('selected');
				    }

		            // ratingStarEvent();

		            
		            document.getElementById("product_vendor_purchase_price").value = price;
		            $("#product_vendor_purchase_title").text(name);


		            $('#submitProductVendorPurchase').unbind('click').click(function(){

		            	var rating = 0;
		            	// var rating = parseInt($('#stars li.selected').last().data('value'), 10);

		            	console.log(rating);
						
						var qty = document.getElementById("product_vendor_purchase_quantity").value;
						arrProduct.push({
							partner_id:partnerId,
							product_id:productId,
							name:name,
							price:document.getElementById("product_vendor_purchase_price").value,
							quantity:qty,
							vendor_name:partnerName,
							subtotal:parseInt(qty)*parseInt(document.getElementById("product_vendor_purchase_price").value),
							quality:rating
						})

						console.log(arrProduct);
						$("#productVendorPurchaseModal").modal('hide');
					    document.getElementById("product_vendor_purchase_quantity").value = 0;
					          	
						$('#submitProductVendorPurchase').removeAttr('disabled');

						//update price comodity

						var dataSend = {
							id : supplierId,
							price : document.getElementById("product_vendor_purchase_price").value
						}
						$.ajax({
					          type: "POST",
					          url: "/update/purchase/comodity/price",
					          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					          // The key needs to match your method's input parameter (case-sensitive).
					          data: JSON.stringify(dataSend),
					          contentType: "application/json; charset=utf-8",
					          dataType: "json",
					          success: function(data){

					          	 console.log(data);
					          }
					    })

						document.getElementById("badge_purchase_cart").innerHTML=  arrProduct.length;

						$.LoadingOverlay("show");
						$.LoadingOverlay("hide");

						$("#chooseProductVendorSuccessAdd").modal();
					    
					})


					

		 			$('#cancelProductVendorPurchase').unbind('click').click(function(){
		 				
		 				console.log(productId);

		 				$('#product_vendor_purchase_label_'+productId).removeClass("active");
		 				$('#checkbox_product_purchase_'+productId).prop('checked', false);

		 				
		 			})

		            
		        }else{

		        	console.log(productId);
		        	for (var i = 0; i < arrProduct.length; i++) {
		        		if (arrProduct[i].product_id==productId) {
		        			console.log('same');
		        			arrProduct.splice(i,1);
		        			break;
		        		}
		        	}
		 			
		 			console.log(arrProduct);

		        }



		    });

			$('.add-comodity-purchase').unbind('click').click(function(){
				console.log('test');
				var VName = $("#vendor_purchase option:selected").text();
				var Vid = $("#vendor_purchase option:selected").val();
				console.log(VName);
				console.log(Vid);
				window.location.href="/edit/vendor/product?vendor_id="+Vid+"&vendor_name="+VName;
			})

			$('.add-vendor-purchase').unbind('click').click(function(){

				window.location.href="/vendors";

			})

 			$('#nextProductVendorPurchase').unbind('click').click(function(){
 				console.log(arrProduct);

	        	//post data arrProduct
	        	var dataSend = {
			         arr_product : arrProduct
			    }

			    $.LoadingOverlay("show");


			    if(arrProduct.length==0){

			    	$.LoadingOverlay("hide");

			    	$("#chooseProductVendorFailed").modal();

			    	$('#nextProductVendorPurchase').removeAttr('disabled');

			    }else{

			    	$.ajax({
			          type: "POST",
			          url: "/data/product/vendor/purchase",
			          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
			          // The key needs to match your method's input parameter (case-sensitive).
			          data: JSON.stringify(dataSend),
			          contentType: "application/json; charset=utf-8",
			          dataType: "json",
			          success: function(data){

			            console.log(data);

	        			$('#nextProductVendorPurchase').removeAttr('disabled');

	        			$.LoadingOverlay("hide");

			            window.location.href="/cart/product/purchase";

			            
			          },
			          failure: function(errMsg) {
			              alert(errMsg);
			          }
			      });

			    }

			   
	        })
				            
            
          },
          failure: function(errMsg) {
              alert(errMsg);
          }
      });
}

function getDataProductVendorPurchase () {

	var arrProduct = [];

	$(document).ready(function() {
		// var editor = new $.fn.dataTable.Editor( {
		// 	        idSrc:  'product_id',
		// 	        table: "#dataTables-cart-purchase",
		// 		    fields: [ {
				           
		// 		            label: "Kuantitas:",
		// 		            name: "quantity"
				        
		// 		        }
		// 		    ]
		// 	  })

	    var table = $('#dataTables-cart-purchase').DataTable({
	        responsive : true,
	        paging:   false,
        	ordering: false,
        	info:     false,
        	searching: false,
	        ajax : {
	            "url" : "/data/product/vendor/purchase"
	        },
	        columns : [ {
	            "data" : "name"
	        // }, {
	        // 	"data" : "quality"
	        }, {
	        	"data" : "price"
	        }, {
	            "data" : "quantity"
	        }, {
	            "data" : "subtotal"
	        }, {
	            "data" : "action"
	        }],
	        keys: true
	    });

	    $('#dataTables-cart-purchase').on('click', '.delete-cart-purchase', function(){

			console.log('test');
			table.row( $(this).parents('tr') ).remove().draw();

			var totalAccumulative = 0;

	    	for(var k=0; k<table.rows().data().length; k++){
	    		totalAccumulative = totalAccumulative + table.row(k).data().subtotal;
	    	}

	    	$('#total_cart_purchase').text(totalAccumulative);

		})

		$('#dataTables-cart-purchase').on('click', '.edit-cart-purchase', function(){

			console.log('test');
			var row  = $(this).parents('tr')[0];

		    //for row data
		    console.log( table.row( row ).data() );
		    console.log( table.row( row ).index() );

		    var idxRow = table.row( row ).index();

		    $("#editCartPurchaseModal").modal({backdrop: 'static', keyboard: false});

		    document.getElementById('cart_purchase_price').value = table.row( row ).data().price;
		    document.getElementById('cart_purchase_quantity').value = table.row( row ).data().quantity;

		    //RATING
      //       var ratingVal = table.row( row ).data().quality;
      //       var stars = $('#stars li').parent().children('li.star');

      //       for (i = 0; i < ratingVal; i++) {
		    //   $(stars[i]).addClass('selected');
		    // }

	        // ratingStarEvent();

		    $('#submitCartPurchase').unbind('click').click(function(){
		    	
		    	$("#editCartPurchaseModal").modal('hide');

		    	$('.modal-backdrop').remove();

		    	var qual = 0;
		    	// var qual = parseInt($('#stars li.selected').last().data('value'), 10);
		    	// table.cell(idxRow,1).data(qual);

		    	//price
		    	table.cell(idxRow,1).data(document.getElementById('cart_purchase_price').value);

		    	var qty = document.getElementById('cart_purchase_quantity').value;
		    	table.cell(idxRow,2).data(qty);
		    	var subtotal = parseInt(qty) * parseInt(document.getElementById('cart_purchase_price').value); 
		    	table.cell(idxRow,3).data(subtotal);

		    	var totalAccumulative = 0;

		    	for(var k=0; k<table.rows().data().length; k++){
		    		totalAccumulative = totalAccumulative + table.row(k).data().subtotal;
		    	}

		    	$('#total_cart_purchase').text(totalAccumulative);


		    })


		})

		$('#confirmPurchase').unbind('click').click(function(){
			
			var arrCart = [];
			for (var i = 0; i < table.rows().data().length; i++) {
				console.log(table.row(i).data());
				arrCart.push(table.row(i).data());
			}

			var dataSend = {
		         arr_product : arrCart
		    }

		   $.LoadingOverlay("show");

		   $.ajax({
		          type: "POST",
		          url: "/data/cart/purchase",
		          headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
		          // The key needs to match your method's input parameter (case-sensitive).
		          data: JSON.stringify(dataSend),
		          contentType: "application/json; charset=utf-8",
		          dataType: "json",
		          success: function(data){

		            console.log(data);
		            $('#confirmPurchase').removeAttr('disabled');

		            $.LoadingOverlay("hide");

		            window.location.href="/purchase";
        	
		            
		          },
		          failure: function(errMsg) {
		              alert(errMsg);
		          }
		      });


		})

		// $('#dataTables-cart-purchase').on( 'click', 'tbody td', function () {
		//     table.cell( this ).edit();
		//     console.log(table.row( this ).data());

		//     indexRow = table.row( this ).index();
		// });

		// table.on( 'key', function ( e, datatable, key, cell, originalEvent ) {
		//     if ( key === 13 ) { // return

		//     	console.log(table.cell(indexRow,2).data());
		//     }
		// } );

		 

		
	});

	

	$.ajax({
       type:'GET',
       url:'/data/product/vendor/purchase',
       // async: true,
       success:function(data){ 		

 			//get vendor
       		console.log(data);

       		var result = data;
       		var accTotal = 0;

       		for (var i = 0; i < result.data.length; i++) {
       			
       			accTotal = accTotal + parseInt(result.data[i].subtotal);
       		}

       		console.log(accTotal);

       		$('#total_cart_purchase').text(accTotal);


       }
    })
}

function ratingStarEvent(){
	/* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    
  });
}

//////////////////////////////////////////////////////INVENTORY//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function getInventoryComodity(){

	$.ajax({
		type:'GET',
		url:'/get/product',
		// async: true,

		success:function(data){

			console.log(data);

			var result = data;

			var htmlEmptyProductInventory = '<div class="row">'+
					            '<div class="col-sm-12">'+
					                '<div class="panel panel-default">'+
					    
					            '<div class="panel-body" style="height: 30vh;padding-top: 10vh;">'+
					            '<div class="text-center"><h4><b>Komoditas Kosong</b></h4></div>'+
					        '</div>'+
					    
					    '</div>'+

			            '</div>'+
        			'</div>'

        	var productInventoryHtml = "";

			if(result.data.length==0){
				$('#product_inventory_container').html(htmlEmptyProductInventory);
			}else{
				for (var i = 0; i < result.data.length; i++) {

				    if (result.data[i].qty_available==0) {

				    	productInventoryHtml =  '<div class="items col-sm-2 item-product-vendor" data-id="'+result.data[i].id+'">'+
                                            '<div class="info-block block-info clearfix">'+
                                                
                                                '<div data-toggle="buttons" id="'+result.data[i].id+'" data-id="'+result.data[i].id+'" data-name="'+result.data[i].name+'" class="btn-group bizmoduleselect vendor-inventory-btn">'+
                                                    
                                                    '<label class="btn btn-default" id="product_vendor_label_'+result.data[i].id+'" style="padding: 0;background-color:darkred;">'+

                                                       '<img style="width: 100%;position: relative;margin-bottom: -20px;" src="data:image/jpeg;base64,'+result.data[i].image_medium+'">'+
                                             			  
                                             			  '<div style="background:#000000b8;color:white;position: absolute;width: 100%;">Stok : <span style="font-weight:bold;">'+result.data[i].qty_available+'</span> Kg</div>'+

                                                         '<div class="bizcontent" style="margin-top: 30px;">'+
                                                            '<h5 style="font-weight:bold;color: white;">'+result.data[i].name+'</h5>'+
                                                            '<h5 style="color: white;">'+result.data[i].x_kategori_produk+'</h5>'+
                                                            
                                                        '</div>'+
                                                    '</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
		            	
	                }else{

	                	productInventoryHtml =  '<div class="items col-sm-2 item-product-vendor" data-id="'+result.data[i].id+'">'+
                                            '<div class="info-block block-info clearfix">'+
                                                
                                                '<div data-toggle="buttons" id="'+result.data[i].id+'" data-id="'+result.data[i].id+'" data-name="'+result.data[i].name+'" class="btn-group bizmoduleselect vendor-inventory-btn">'+
                                                    
                                                    '<label class="btn btn-default" id="product_vendor_label_'+result.data[i].id+'" style="padding: 0;">'+
                                                       '<img style="width: 100%;position: relative;margin-bottom: -20px;" src="data:image/jpeg;base64,'+result.data[i].image_medium+'">'+
                                             			  
                                             			  '<div style="background:#000000b8;color:white;position: absolute;width: 100%;">Stok : <span style="font-weight:bold;">'+result.data[i].qty_available+'</span> Kg</div>'+

                                                         '<div class="bizcontent" style="margin-top: 30px;">'+
                                                            '<h5 style="font-weight:bold;">'+result.data[i].name+'</h5>'+
                                                            '<h5>'+result.data[i].x_kategori_produk+'</h5>'+
                                                            
                                                        '</div>'+
                                                    '</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';

	                }

				

                 $('#product_inventory_container').append(productInventoryHtml);
			   }
			}

			

			$('.vendor-inventory-btn').click(function(){
				var id = $(this).data('id');
				var name = $(this).data('name');

				console.log(id);

				window.location.href="/inventory/comodity/item?product_id="+id+"&name="+name;

			})

		}
	})

}

function getInventoryComodityItem(){
	var productId = JSON.parse(getParameterByName('product_id'));
	var productName = JSON.stringify(getParameterByName('name')).replace(/['"]+/g, '');

	console.log(productId);

	var dataSend = {
		product_id : productId
	}


	$.ajax({
		  type: "POST",
		  url: "/inventory/comodity/item",
		  headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
		  // The key needs to match your method's input parameter (case-sensitive).
		  data: JSON.stringify(dataSend),
		  contentType: "application/json; charset=utf-8",
		  dataType: "json",
		  success: function(data){

		  	console.log(data);
		  
	  		var name = "Komoditas "+productName;
			$('.page-header-custom').text(name);


			$(document).ready(function() {
			    $('#dataTables-inventory-comodity').DataTable({
			        responsive : true,
			        ajax : {
			            "url" : "/get/inventory/comodity/item"
			        },
			        columns : [ {
			            "data" : "date_order"
			        }, {
			        	"data" : "partner_id.1"
			       	}, {
			        	"data" : "origin"
			        }, {
			            "data" : "price_unit"
			        }, {
			            "data" : "product_qty"
			        }, {
			            "data" : "price_subtotal"
			        }, {
			            "data" : "x_quality_product"
		            }]
			    });


			});
		    
		  },
		  failure: function(errMsg) {
		      alert(errMsg);
		  }
		});


 		$.ajax({
		  type: "POST",
		  url: "/inventory/process/item",
		  headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
		  // The key needs to match your method's input parameter (case-sensitive).
		  data: JSON.stringify(dataSend),
		  contentType: "application/json; charset=utf-8",
		  dataType: "json",
		  success: function(data){

		  	console.log(data);

		    $(document).ready(function() {

			    $('#dataTables-inventory-comodity-process').DataTable({
			        responsive : true,
			        ajax : {
			            "url" : "/get/inventory/process/item"
			        },
			        columns : [ {
			            "data" : "qty"
			        }, {
			        	"data" : "jc"
			       	}, {
			        	"data" : "jk"
			        }, {
			            "data" : "proses"
			        }, {
			            "data" : "final"
			        }, {
			            "data" : "action"
			        }]
			    });

			    $('#dataTables-inventory-comodity-result').DataTable({
			        responsive : true,
			        ajax : {
			            "url" : "/get/inventory/process/item"
			        },
			        columns : [ {
			            "data" : "proses"
			        }, {
			        	"data" : "grade1"
			       	}, {
			        	"data" : "grade2"
			        }, {
			            "data" : "grade3"
			        }, {
			            "data" : "grade4"
			        }, {
			        	"data" : "grade5"
			        }, {
			        	"data" : "grade6"
			        }, {
			            "data" : "actionResult"
			        }]
			    });


			});

			$('#dataTables-inventory-comodity-process').on('click', '.edit-vendor-comodity-process', function(){

				var id = $(this).data('id');
				var qty = $(this).data('qty');
				var jk = $(this).data('jk');
				var jc = $(this).data('jc');
				var finalVal = $(this).data('final');
				var proses = $(this).data('proses');

				console.log(qty);

				$("#updateVendorComodityProcessModal").modal({backdrop: 'static', keyboard: false});

				document.getElementById('update_vendor_process_process').value = proses;
				document.getElementById('update_vendor_process_qty').value = qty;
				document.getElementById('update_vendor_process_jc').value = jc;
				document.getElementById('update_vendor_process_jk').value = jk;
				document.getElementById('update_vendor_process_final').value = finalVal;

				$('#updateVendorProcess').unbind('click').click(function(){

					$("#updateVendorComodityProcessModal").modal('hide');

					var dataSend = {
						id : id,
						process : proses,
						jc : document.getElementById('update_vendor_process_jc').value,
						jk : document.getElementById('update_vendor_process_jk').value,
						final_val : document.getElementById('update_vendor_process_final').value
					}

					$.ajax({
					  type: "POST",
					  url: "/update/inventory/process",
					  headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					  // The key needs to match your method's input parameter (case-sensitive).
					  data: JSON.stringify(dataSend),
					  contentType: "application/json; charset=utf-8",
					  dataType: "json",
					  success: function(data){

					  	console.log(data);
					  	location.reload();
					 },
					  failure: function(errMsg) {
					      alert(errMsg);
					  }
					});
				

				})
				
			})

 			$('#dataTables-inventory-comodity-result').on('click', '.edit-vendor-comodity-result', function(){

				var id = $(this).data('id');
				var grade1 = $(this).data('grade1');
				var grade2 = $(this).data('grade2');
				var grade3 = $(this).data('grade3');
				var grade4 = $(this).data('grade4');
				var grade5 = $(this).data('grade5');
				var grade6 = $(this).data('grade6');
				
				var proses = $(this).data('proses');

				console.log(proses);

				$("#updateVendorComodityResultModal").modal({backdrop: 'static', keyboard: false});

				document.getElementById('update_vendor_result_process').value = proses;
				document.getElementById('update_vendor_result_grade1').value = grade1;
				document.getElementById('update_vendor_result_grade2').value = grade2;
				document.getElementById('update_vendor_result_grade3').value = grade3;
				document.getElementById('update_vendor_result_grade4').value = grade4;
				document.getElementById('update_vendor_result_grade5').value = grade5;
				document.getElementById('update_vendor_result_grade6').value = grade6;
				
				$('#updateVendorResult').unbind('click').click(function(){

					$("#updateVendorComodityResultModal").modal('hide');

					var dataSend = {
						id : id,
						process : proses,
						grade1 : document.getElementById('update_vendor_result_grade1').value,
						grade2 : document.getElementById('update_vendor_result_grade2').value,
						grade3 : document.getElementById('update_vendor_result_grade3').value,
						grade4 : document.getElementById('update_vendor_result_grade4').value,
						grade5 : document.getElementById('update_vendor_result_grade5').value,
						grade6 : document.getElementById('update_vendor_result_grade6').value
					}

					$.ajax({
					  type: "POST",
					  url: "/update/inventory/result",
					  headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					  // The key needs to match your method's input parameter (case-sensitive).
					  data: JSON.stringify(dataSend),
					  contentType: "application/json; charset=utf-8",
					  dataType: "json",
					  success: function(data){

					  	console.log(data);
					  	// location.reload();
					 },
					  failure: function(errMsg) {
					      alert(errMsg);
					  }
					});
				

				})
				
			})



		    
		  },
		  failure: function(errMsg) {
		      alert(errMsg);
		  }
		});

}

function getDataStockInventory(){

	$(document).ready(function() {

			    $('#dataTables-stock-inventory-comodity').DataTable({
			        responsive : true,
			        ajax : {
			            "url" : "/get/inventory/stock"
			        },
			        columns : [ {
			            "data" : "name"
			        }, {
			        	"data" : "proses"
			       	}, {
			        	"data" : "grade1"
			        }, {
			            "data" : "grade2"
			        }, {
			            "data" : "grade3"
			        }, {
			            "data" : "grade4"
			        }, {
			            "data" : "grade5"
			        }, {
			            "data" : "grade6"
			        }]
			    });	
	})

	$.ajax({
		type:'GET',
		url:'/get/inventory/stock',
		// async: true,

		success:function(data){

			console.log(data);

		}
	})
}


//////////////////////////////////////////////////////DASHBOARD/////////////////////////////////////////////////////////////////////////////////////////////////////////////


function getDashboardCount(){

	$.ajax({
		type:'GET',
		url:'/get/dashboard/count',
		// async: true,

		success:function(data){

			console.log(data);

			//COUNT DASHBOARD
			$('#purchase_order_count').each(function () {
			    $(this).prop('Counter',0).animate({
			        Counter: data.data[0]
			    }, {
			        duration: 1000,
			        easing: 'swing',
			        step: function (now) {
			            $(this).text(Math.ceil(now));
			        }
			    });
			});

			$('#product_count').each(function () {
			    $(this).prop('Counter',0).animate({
			        Counter: data.data[1]
			    }, {
			        duration: 1000,
			        easing: 'swing',
			        step: function (now) {
			            $(this).text(Math.ceil(now));
			        }
			    });
			});

			$('#vendor_count').each(function () {
			    $(this).prop('Counter',0).animate({
			        Counter: data.data[2]
			    }, {
			        duration: 1000,
			        easing: 'swing',
			        step: function (now) {
			            $(this).text(Math.ceil(now));
			        }
			    });
			});


			$('#purchase_order_transaction_total').text(comma_digits(data.data[5]));
			$('#total_komoditas_transaction_total').text(comma_digits(data.data[3]));


			//CHART STOCK

			var pdata = [];
			var pAttribute =[];
			var emptyStock = 0;

			for (var i = 0; i < data.data[4].length; i++) {

				pAttribute.push(data.data[4][i].name,data.data[4][i].qty_available);

				pdata.push(pAttribute);

				pAttribute = [];

				if(data.data[4][i].qty_available==0){
					emptyStock++;
				}
			}

			$('#comodity_count').each(function () {
			    $(this).prop('Counter',0).animate({
			        Counter: emptyStock
			    }, {
			        duration: 1000,
			        easing: 'swing',
			        step: function (now) {
			            $(this).text(Math.ceil(now));
			        }
			    });
			});

			console.log(pdata);

			Highcharts.chart('product_stock_chart', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: ''
				    },
				    xAxis: {
				        type: 'category',
				        labels: {
				            rotation: -45,
				            style: {
				                fontSize: '13px',
				                fontFamily: 'Verdana, sans-serif'
				            }
				        }
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: 'Jumlah (Kg)'
				        }
				    },
				    legend: {
				        enabled: false
				    },
				    tooltip: {
				        pointFormat: 'Komoditas: <b>{point.y:.1f} Kg</b>'
				    },
				    series: [{
				        name: 'Komoditas',
				        data: pdata,
				        dataLabels: {
				            enabled: true,
				            rotation: -90,
				            color: '#FFFFFF',
				            align: 'right',
				            format: '{point.y:.1f}', // one decimal
				            y: 10, // 10 pixels down from the top
				            style: {
				                fontSize: '13px',
				                fontFamily: 'Verdana, sans-serif'
				            }
				        }
				    }]
				});


		}
	})

}

function comma_digits(text_number){ 
    if(typeof text_number == 'number'){
        text_number = text_number.toString();
    }    
    return  text_number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"); 
}

function getPurchaseReport(){
	$.ajax({
		type:'GET',
		url:'/get/purchase/report',
		// async: true,

		success:function(data){

			// console.log(data);

			var result = data;
			var arrVendor = [];

			for (var i = 0; i < result.data.length; i++) {
				arrVendor.push(result.data[i].commercial_partner_id[1]);
			}

			var uniqueNames = [];
			$.each(arrVendor, function(i, el){
			    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
			});

			// console.log(uniqueNames);
			var arrChart = [];
			var arrTotalPrice = [];
			var total_price = 0;

			for (var i = 0; i < uniqueNames.length; i++) {

				for (var j = 0; j < result.data.length; j++) {

					if (result.data[j].commercial_partner_id[1]==uniqueNames[i]) {
						total_price = total_price + result.data[j].price_total;
					}
				}

				arrTotalPrice.push(total_price);

				arrChart.push({
					name : uniqueNames[i],
					data : arrTotalPrice
				})

				arrTotalPrice = [];
				total_price = 0;
			}

			console.log(arrChart);

			Highcharts.chart('cline', {
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'column'
		        },
		        title: {
		            text: 'Vendor Product Purchase'
		        },
		     	xAxis: {
				    categories: ['vendor'],
				    crosshair: true
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: 'Total Price'
				        }
				    },
				    tooltip: {
				        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				        pointFormat: '<tr><td >{series.name}: </td>' +
				            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
				        footerFormat: '</table>',
				        shared: true,
				        useHTML: true
				    },
				    plotOptions: {
				        column: {
				            pointPadding: 0.2,
				            borderWidth: 0
				        }
				    },
				    series: arrChart
		    });

		}

   })

}

function getInventoryValuation(){
	$.ajax({
		type:'GET',
		url:'/get/inventory/valuation',
		// async: true,

		success:function(data){
			console.log(data);

			var pdata = [];
			var result = data;

			for (var i = 0; i < result.data.length; i++) {

				pdata.push({
					y: result.data[i].inventory_value,
			        name: result.data[i].name

				})
			}

			Highcharts.chart('cdonut', {
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        title: {
		            text: 'Product Inventory Valuation'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: false
		                },
		                showInLegend: true
		            }
		        },
		        series: [{
		            name: 'Amount',
		            colorByPoint: true,
		            data: pdata
		        }]
		    });


		}
	})
}

function getPurchaseProduct(){
    $.ajax({
       type:'GET',
       url:'/get/purchase/product',
       // async: true,

       success:function(data){

       		console.log(data);

       		var result = data;
			var pdata = [];

			for (var i = 0; i < result.data.length; i++) {

				pdata.push({
					y: result.data[i].total_cost,
			        name: result.data[i].name

				})
			}

			Highcharts.chart('cpie', {
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        title: {
		            text: 'Product Purchase Cost'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: false
		                },
		                showInLegend: true
		            }
		        },
		        series: [{
		            name: 'Amount',
		            colorByPoint: true,
		            data: pdata
		        }]
		    });

       }
     })
}