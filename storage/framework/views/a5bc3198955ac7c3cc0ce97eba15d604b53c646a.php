<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dragom Mart | POS API Docs</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/fontawesome/js/all.min.js"></script>

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/css/theme.css">

</head>

<body class="docs-page">
    <header class="header fixed-top">
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible mr-2 d-xl-none" type="button">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </button>
	                <div class="site-logo">
                    <a class="navbar-brand" href="index.html">
                      <img class="logo-icon mr-2" src="<?php echo e(url('assets/img/logo_text.png')); ?>" alt="logo" height="40">
                    <span class="logo-text">API<span class="text-alt"> Docs</span></span>
                  </a>
                </div>
                </div><!--//docs-logo-wrapper-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->

    <div class="docs-wrapper">
	    <div id="docs-sidebar" class="docs-sidebar">
		    <div class="top-search-box d-lg-none p-3">
                <form class="search-form">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
            </div>
		    <nav id="docs-nav" class="docs-nav navbar">
			    <ul class="section-items list-unstyled nav flex-column pb-3">
            <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#Quick_Start"><span class="theme-icon-holder mr-2"><i class="fas fa-box"></i></span>Quick Start</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#API_Key">API Key</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#Public_Responses">Public Responses</a></li>
            <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#V10"><span class="theme-icon-holder mr-2"><i class="fas fa-box"></i></span>V1.0</a></li>
            <li class="nav-item"><a class="nav-link scrollto" href="#Add_new_category">Add new category</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#Update_category">Update category</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#Delete_category">Delete category</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#category_list">Get categories</a></li>
            <li class="nav-item"><a class="nav-link scrollto" href="#Add_new_product">Add new product</a></li>
            <li class="nav-item"><a class="nav-link scrollto" href="#Update_product">Update product</a></li>
            <li class="nav-item"><a class="nav-link scrollto" href="#Delete_product">Delete product</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#product_list">Get products</a></li>
			    </ul>

		    </nav><!--//docs-nav-->
	    </div><!--//docs-sidebar-->
	    <div class="docs-content p-0">
		    <div class="container">
			    <article class="docs-article" id="Quick_Start">
				    <header class="docs-header">
					    <h1 class="docs-heading">Quick Start <span class="docs-time">Last updated: 2020-11-24</span></h1>
					    <section class="docs-intro">
						    <p>Welcome to <b>Dragon Mart</b> POS API</p>
						</section><!--//docs-intro-->

						<h5>Constants</h5>
            <strong class="mr-1">URL :</strong> <code><?php echo e(url('')); ?>/api/{Version}/POS</code>
				    </header>
				    <section class="docs-section" id="API_Key">
						<h2 class="section-heading">API Key</h2>
						<p>You can get the <b>API Key</b> by contacting with the application administration</p>

            <div class="callout-block callout-block-danger mr-1">
                <div class="content">
                    <h4 class="callout-title">
                      <span class="callout-icon-holder">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span><!--//icon-holder-->
                      Note
                  </h4>
                    <p>We are not responsible for publishing your <b>API Key</b> so please keep it safe</p>
                </div><!--//content-->
            </div><!--//callout-block-->

					</section><!--//section-->

					<section class="docs-section" id="Public_Responses">

						<h2 class="section-heading">Public Responses</h2>
						<p>There are a Public Response For the API you must know it to be dial with API successfully </p>
            <h5 class="danger">Errors Responses:</h5>
            <div class="table-responsive my-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>Status Code</td>
                    <td>Response</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="bg-light">4221</th>
                    <td>The Api Key is required</td>
                  </tr>
                  <tr>
                    <th class="bg-light">4222</th>
                    <td>The Api Key not corrcet</td>
                  </tr>
                  <tr>
                    <th class="bg-light">4223</th>
                    <td>Some required data missing</td>
                  </tr>
                  <tr>
                    <th class="bg-light">4224</th>
                    <td>Not found the category</td>
                  </tr>
                  <tr>
                    <th class="bg-light">4224</th>
                    <td>Not found the product</td>
                  </tr>

                </tbody>
              </table>
            </div><!--//table-responsive-->

            <h5 class="danger">Success Responses:</h5>
            <div class="table-responsive my-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>Status Code</td>
                    <td>Response</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="bg-light">2001</th>
                    <td>The Category added successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2002</th>
                    <td>The Category updated successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2003</th>
                    <td>The Category deleted successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2004</th>
                    <td>Get categories successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2005</th>
                    <td>The Product added successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2006</th>
                    <td>The Product updated successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2007</th>
                    <td>The Product deleted successfully</td>
                  </tr>
                  <tr>
                    <th class="bg-light">2008</th>
                    <td>Get products successfully</td>
                  </tr>

                </tbody>
              </table>
            </div><!--//table-responsive-->

					</section><!--//section-->


			    </article>

<article class="docs-article" id="V10">
  <header class="docs-header">
    <h1 class="docs-heading">Version 1.0</h1>
  </header>
  <section class="docs-section" id="Add_new_category">
    <h2 class="section-heading">Add new category</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/category/new</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The category id in your system</p>
        </li>
        <li>
          <p>name <code>(String)</code> : Required | The category name in English</p>
        </li>
        <li>
          <p>name_ar <code>(String)</code> : Required | The category name in Arabic</p>
        </li>
        <li>
          <p>order_by <code>(Number)</code> : Optional | The category order in the Store Page</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
            {
              "api_key" : {API_KEY},
              "reference_id" : "12",
              "name" : "test",
              "name_ar" : "test",
              "order_by" : 2
            }
          </code>
        </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
            {
              "status": true,
              "statusCode": 2001,
              "message": "The Category added successfully",
              "items": {
                "id": 329,
                "name": "test",
                "name_ar": "test",
                "store_id": 100,
                "order_by": 2,
                "reference_id": "12",
                "updated_at": "2020-09-26 16:54:17",
                "created_at": "2020-09-26 16:54:17",
                "icon32": "http://saudidragonmart.com/assets/unknown_ic.png"
              }
          </code>
        </pre>
      </div>

    </div>


  </section>

  <section class="docs-section" id="Update_category">
    <h2 class="section-heading">Update category</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/category/update</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The category id in your system</p>
        </li>
        <li>
          <p>name <code>(String)</code> : Required | The category name in English</p>
        </li>
        <li>
          <p>name_ar <code>(String)</code> : Required | The category name in Arabic</p>
        </li>
        <li>
          <p>order_by <code>(Number)</code> : Optional | The category order in the Store Page</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
            "name" : "salam",
            "reference_id" : "12",
            "name_ar" : "salam",
            "order_by" : ""
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

        {
          "status": true,
          "statusCode": 2002,
          "message": "The Category updated successfully",
          "items": {
            "id": 329,
            "reference_id": "12",
            "order_by": null,
            "name": "salam",
            "name_ar": "salam",
            "description": null,
            "icon": "http://saudidragonmart.com/assets/unknown_ic.png",
            "store_id": 100,
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-09-26 11:39:00",
            "updated_at": "2020-09-26 11:58:25",
            "icon32": "http://saudidragonmart.com/assets/unknown_ic.png"
          }
        }


      </code>

       </pre>
      </div>

    </div>


  </section>

  <section class="docs-section" id="Delete_category">
    <h2 class="section-heading">Delete category</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/category/delete</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The category id in your system</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
            "reference_id" : "12"
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

        {
          "status": true,
          "statusCode": 2003,
          "message": "The Category deleted successfully",
          "items": []
        }


      </code>

       </pre>
      </div>

    </div>


  </section>

  <section class="docs-section" id="category_list">
    <h2 class="section-heading">Get categories</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/category/get</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Optional | The category id in your system</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

{
    "status": true,
    "statusCode": 2005,
    "message": "Get categories successfully",
    "items": [
        {
            "id": 490,
            "reference_id": "12",
            "order_by": null,
            "name": "test",
            "name_ar": "test",
            "description": null,
            "icon": "",
            "store_id": "572",
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-10-21 08:43:39",
            "updated_at": "2020-10-21 08:43:39",
            "icon32": ""
        },
        {
            "id": 491,
            "reference_id": "15",
            "order_by": null,
            "name": "test",
            "name_ar": "test",
            "description": null,
            "icon": "",
            "store_id": "572",
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-10-21 08:45:20",
            "updated_at": "2020-10-21 08:45:20",
            "icon32": ""
        },
        {
            "id": 492,
            "reference_id": "18",
            "order_by": null,
            "name": "test",
            "name_ar": "test",
            "description": null,
            "icon": "",
            "store_id": "572",
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-10-21 08:45:24",
            "updated_at": "2020-10-21 08:45:24",
            "icon32": ""
        }
    ]
}


      </code>

       </pre>
      </div>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
            "reference_id" : "12",
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

{
    "status": true,
    "statusCode": 2005,
    "message": "Get categories successfully",
    "items":{
            "id": 490,
            "reference_id": "12",
            "order_by": null,
            "name": "test",
            "name_ar": "test",
            "description": null,
            "icon": "",
            "store_id": "572",
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-10-21 08:43:39",
            "updated_at": "2020-10-21 08:43:39",
            "icon32": ""
        },
}
      </code>

       </pre>
      </div>
    </div>


  </section>


  <section class="docs-section" id="Add_new_product">
    <h2 class="section-heading">Add new product</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/product/new</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The product id in your system</p>
        </li>
        <li>
          <p>name <code>(String)</code> : Required | The product name</p>
        </li>
        <li>
          <p>price <code>(Number)</code> : Required | The product price (####.##)</p>
        </li>
        <li>
          <p>original_quantity <code>(Number)</code> : Required | The product quantity in te store</p>
        </li>
        <li>
          <p>barcode <code>(String)</code> : Optional | The product barcode</p>
        </li>
        <li>
          <p>category_id <code>(Number)</code> : Required | The category id from your system , you must add the category first to use it</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
      <pre class="rounded">
      <code class="json hljs">
      {
        "api_key" : {API_KEY},
        "reference_id" : "100",
        "name" : "salam",
        "price" : 25,
        "original_quantity" : 20,
        "barcode" : 155554565582,
        "category_id" : 12,
      }
    </code>
  </pre>
 </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">
        {
          "status": true,
          "statusCode": 2003,
          "message": "The Product added successfully",
          "items": {
            "id": 5427,
            "reference_id": "100",
            "name": "salam",
            "price": 25,
            "original_quantity": 20,
            "category_id": 327,
            "merchant_id": 100,
            "store_id": 100,
            "updated_at": "2020-09-26 17:21:19",
            "created_at": "2020-09-26 17:21:19",
          }
        }
      </code>

           </pre>
      </div>

    </div>


  </section>


  <section class="docs-section" id="Update_product">
    <h2 class="section-heading">Update product</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/product/update</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The product id in your system</p>
        </li>
        <li>
          <p>name <code>(String)</code> : Required | The product name</p>
        </li>
        <li>
          <p>price <code>(Number)</code> : Required | The product price (####.##)</p>
        </li>
        <li>
          <p>original_quantity <code>(Number)</code> : Required | The product quantity in te store</p>
        </li>
        <li>
          <p>barcode <code>(String)</code> : Optional | The product barcode</p>
        </li>
        <li>
          <p>category_id <code>(Number)</code> : Required | The category id from your system , you must add the category first to use it</p>
        </li>
        <li>
          <p>quantity_type <code>(String)</code> : Required | if you want to add to the original quantity use <b>"add"</b> or if you wnat to change the value of original quantity use <b>"update"</b> </p>
        </li>



      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
      <pre class="rounded">
      <code class="json hljs">
      {
        "api_key" : {API_KEY},
        "reference_id" : "100",
        "name" : "salam2",
        "price" : 10,
        "original_quantity" : 10,
        "barcode" : 155554565582,
        "quantity_type" : "update",
        "category_id" : 12,
      }
    </code>
  </pre>
 </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">
        {
          "status": true,
          "statusCode": 2004,
          "message": "The Product updated successfully",
          "items": {
            "id": 5427,
            "reference_id": "100",
            "name": "salam2",
            "price": 10,
            "original_quantity": 10,
            "available_quantity": 10,
            "category_id": 327,
            "merchant_id": 100,
            "store_id": 100,
            "updated_at": "2020-09-26 17:21:19",
            "created_at": "2020-09-26 17:21:19",
          }
        }
      </code>

           </pre>
      </div>

    </div>


  </section>

  <section class="docs-section" id="Delete_product">
    <h2 class="section-heading">Delete product</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/product/delete</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Required | The product id in your system</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
            "reference_id" : "100"
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

        {
          "status": true,
          "statusCode": 2008,
          "message": "The Product deleted successfully",
          "items": []
        }


      </code>

       </pre>
      </div>

    </div>


  </section>

  <section class="docs-section" id="product_list">
    <h2 class="section-heading">Get products</h2>
    <h5><strong class="mr-1">URL :</strong> <code>{URL}/POS/product/get</code> <code class="bg-primary">POST</code></h5>

    <div class="resourceGroupDescription markdown formalTheme">
      <p><strong>Attributes:</strong></p>
      <ul>
        <li>
          <p>api_key <code>(String)</code> : Required</p>
        </li>
        <li>
          <p>reference_id <code>(Number)</code> : Optional | The category id in your system</p>
        </li>
      </ul>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

{
    "status": true,
    "statusCode": 2006,
    "message": "Get products successfully",
    "items": [
        {
            "id": 6964,
            "reference_id": "100",
            "name": "salam",
            "price": 25,
            "original_quantity": 20,
            "available_quantity": 20,
            "is_offer": 0,
            "offer_percentage": null,
            "is_sponsor": 0,
            "admin_is_sponsor": 0,
            "sponsor_duration": null,
            "end_date_sponsor": null,
            "has_custom": 0,
            "merchant_id": 572,
            "category_id": 490,
            "store_id": 124,
            "description": null,
            "is_active": 1,
            "barcode": null,
            "deleted_at": null,
            "created_at": "2020-10-21 09:05:38",
            "updated_at": "2020-10-21 09:05:38",
            "offer_price": 0,
            "rate": 0,
            "is_rate": false,
            "images": [],
            "category": {
                "id": 490,
                "reference_id": "12",
                "order_by": null,
                "name": "test",
                "name_ar": "test",
                "description": null,
                "icon": "",
                "store_id": "572",
                "parent_id": null,
                "deleted_at": null,
                "created_at": "2020-10-21 08:43:39",
                "updated_at": "2020-10-21 08:43:39",
                "icon32": ""
            },
            "merchant": {
                "id": 572,
                "username": "أسواق اليحيى",
                "email": "yahyamarkeet@gmail.com",
                "email_verified_at": null,
                "mobile": "0567116377",
                "new_mobile": null,
                "country_code_length": 4,
                "is_confirm_code": 0,
                "city_id": 12,
                "address": null,
                "latitude": null,
                "longitude": null,
                "image": null,
                "type": "merchant",
                "is_active": 1,
                "has_delivery": 0,
                "is_driver_available": 1,
                "bio": null,
                "driver_type_id": null,
                "is_reset_password": 0,
                "commission_rate": 0,
                "refund_commission_rate": 0,
                "lang": "en",
                "api_key": {API_KEY},
                "deleted_at": null,
                "created_at": "2020-09-26 17:53:46",
                "updated_at": "2020-10-01 12:24:22",
                "service_rate": null,
                "count_pending_request": null,
                "count_accepted_request": null,
                "count_rejected_request": null,
                "count_finished_request": null,
                "services": null,
                "reviews": null,
                "city": {
                    "id": 12,
                    "name_ar": "الهفوف",
                    "name_en": "Al Hufuf",
                    "deleted_at": null,
                    "created_at": null,
                    "updated_at": null
                },
                "image100": null,
                "image300": null,
                "vehicle": null,
                "min_merchant_price": 200,
                "count_order_sent": 0,
                "count_product_sent": 0,
                "total_revenue": 0,
                "store_images": [],
                "merchant_products": null,
                "store": {
                    "id": 124,
                    "merchant_id": 572,
                    "name": "أسواق اليحيى",
                    "description": null,
                    "lat": null,
                    "lng": null,
                    "phone": null,
                    "deleted_at": null,
                    "created_at": "2020-09-26 17:53:46",
                    "updated_at": "2020-09-26 17:53:46",
                    "categories": [
                        {
                            "id": 11,
                            "reference_id": null,
                            "order_by": 1,
                            "name": "Supermarket",
                            "name_ar": "التموينات",
                            "description": null,
                            "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                            "store_id": null,
                            "parent_id": null,
                            "deleted_at": null,
                            "created_at": "2019-06-14 13:18:40",
                            "updated_at": "2020-09-17 08:36:22",
                            "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                            "pivot": {
                                "store_id": 124,
                                "category_id": 11
                            }
                        }
                    ],
                    "drivers": []
                },
                "merchant_categories": [
                    {
                        "id": 11,
                        "reference_id": null,
                        "order_by": 1,
                        "name": "Supermarket",
                        "name_ar": "التموينات",
                        "description": null,
                        "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                        "store_id": null,
                        "parent_id": null,
                        "deleted_at": null,
                        "created_at": "2019-06-14 13:18:40",
                        "updated_at": "2020-09-17 08:36:22",
                        "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                        "pivot": {
                            "store_id": 124,
                            "category_id": 11
                        }
                    }
                ],
                "order_bought": null,
                "order_pending": null,
                "order_canceled": null,
                "shipments": [
                    {
                        "id": 2,
                        "merchant_id": null,
                        "price": 15,
                        "from": 0,
                        "to": 10,
                        "type": "admin",
                        "min_order_amount": 0,
                        "deleted_at": null,
                        "created_at": "2020-08-20 14:10:20",
                        "updated_at": "2020-08-20 14:11:42"
                    }
                ],
                "has_merchant_driver": 0,
                "has_dragonmart_driver": 0,
                "has_freelancer_driver": 0,
                "driver_follow_type": 0,
                "driver_type": null,
                "unseen_notifications": 0
            },
            "customizations": [],
            "order_count": 0
        },
        {
            "id": 6965,
            "reference_id": "100",
            "name": "salam",
            "price": 25,
            "original_quantity": 20,
            "available_quantity": 20,
            "is_offer": 0,
            "offer_percentage": null,
            "is_sponsor": 0,
            "admin_is_sponsor": 0,
            "sponsor_duration": null,
            "end_date_sponsor": null,
            "has_custom": 0,
            "merchant_id": 572,
            "category_id": 490,
            "store_id": 124,
            "description": null,
            "is_active": 1,
            "barcode": null,
            "deleted_at": null,
            "created_at": "2020-10-21 09:08:39",
            "updated_at": "2020-10-21 09:08:39",
            "offer_price": 0,
            "rate": 0,
            "is_rate": false,
            "images": [],
            "category": {
                "id": 490,
                "reference_id": "12",
                "order_by": null,
                "name": "test",
                "name_ar": "test",
                "description": null,
                "icon": "",
                "store_id": "572",
                "parent_id": null,
                "deleted_at": null,
                "created_at": "2020-10-21 08:43:39",
                "updated_at": "2020-10-21 08:43:39",
                "icon32": ""
            },
            "merchant": {
                "id": 572,
                "username": "أسواق اليحيى",
                "email": "yahyamarkeet@gmail.com",
                "email_verified_at": null,
                "mobile": "0567116377",
                "new_mobile": null,
                "country_code_length": 4,
                "is_confirm_code": 0,
                "city_id": 12,
                "address": null,
                "latitude": null,
                "longitude": null,
                "image": null,
                "type": "merchant",
                "is_active": 1,
                "has_delivery": 0,
                "is_driver_available": 1,
                "bio": null,
                "driver_type_id": null,
                "is_reset_password": 0,
                "commission_rate": 0,
                "refund_commission_rate": 0,
                "lang": "en",
                "api_key": "F86C39B4289E5D7EA1FAC66C3234A",
                "deleted_at": null,
                "created_at": "2020-09-26 17:53:46",
                "updated_at": "2020-10-01 12:24:22",
                "service_rate": null,
                "count_pending_request": null,
                "count_accepted_request": null,
                "count_rejected_request": null,
                "count_finished_request": null,
                "services": null,
                "reviews": null,
                "city": {
                    "id": 12,
                    "name_ar": "الهفوف",
                    "name_en": "Al Hufuf",
                    "deleted_at": null,
                    "created_at": null,
                    "updated_at": null
                },
                "image100": null,
                "image300": null,
                "vehicle": null,
                "min_merchant_price": 200,
                "count_order_sent": 0,
                "count_product_sent": 0,
                "total_revenue": 0,
                "store_images": [],
                "merchant_products": null,
                "store": {
                    "id": 124,
                    "merchant_id": 572,
                    "name": "أسواق اليحيى",
                    "description": null,
                    "lat": null,
                    "lng": null,
                    "phone": null,
                    "deleted_at": null,
                    "created_at": "2020-09-26 17:53:46",
                    "updated_at": "2020-09-26 17:53:46",
                    "categories": [
                        {
                            "id": 11,
                            "reference_id": null,
                            "order_by": 1,
                            "name": "Supermarket",
                            "name_ar": "التموينات",
                            "description": null,
                            "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                            "store_id": null,
                            "parent_id": null,
                            "deleted_at": null,
                            "created_at": "2019-06-14 13:18:40",
                            "updated_at": "2020-09-17 08:36:22",
                            "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                            "pivot": {
                                "store_id": 124,
                                "category_id": 11
                            }
                        }
                    ],
                    "drivers": []
                },
                "merchant_categories": [
                    {
                        "id": 11,
                        "reference_id": null,
                        "order_by": 1,
                        "name": "Supermarket",
                        "name_ar": "التموينات",
                        "description": null,
                        "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                        "store_id": null,
                        "parent_id": null,
                        "deleted_at": null,
                        "created_at": "2019-06-14 13:18:40",
                        "updated_at": "2020-09-17 08:36:22",
                        "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                        "pivot": {
                            "store_id": 124,
                            "category_id": 11
                        }
                    }
                ],
                "order_bought": null,
                "order_pending": null,
                "order_canceled": null,
                "shipments": [
                    {
                        "id": 2,
                        "merchant_id": null,
                        "price": 15,
                        "from": 0,
                        "to": 10,
                        "type": "admin",
                        "min_order_amount": 0,
                        "deleted_at": null,
                        "created_at": "2020-08-20 14:10:20",
                        "updated_at": "2020-08-20 14:11:42"
                    }
                ],
                "has_merchant_driver": 0,
                "has_dragonmart_driver": 0,
                "has_freelancer_driver": 0,
                "driver_follow_type": 0,
                "driver_type": null,
                "unseen_notifications": 0
            },
            "customizations": [],
            "order_count": 0
        }
    ]
}


      </code>

       </pre>
      </div>
      <p><strong>Example:</strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
          <code class="json hljs">
          {
            "api_key" : {API_KEY},
            "reference_id" : "100",
          }
        </code>
      </pre>
      </div>
      <p><strong>Response : <span class="badge badge-success">Success</span> </strong></p>
      <div class="docs-code-block">
        <pre class="rounded">
        <code class="json hljs">

        {
    "status": true,
    "statusCode": 2006,
    "message": "Get products successfully",
    "items": {
        "id": 6964,
        "reference_id": "100",
        "name": "salam",
        "price": 25,
        "original_quantity": 20,
        "available_quantity": 20,
        "is_offer": 0,
        "offer_percentage": null,
        "is_sponsor": 0,
        "admin_is_sponsor": 0,
        "sponsor_duration": null,
        "end_date_sponsor": null,
        "has_custom": 0,
        "merchant_id": 572,
        "category_id": 490,
        "store_id": 124,
        "description": null,
        "is_active": 1,
        "barcode": null,
        "deleted_at": null,
        "created_at": "2020-10-21 09:05:38",
        "updated_at": "2020-10-21 09:05:38",
        "offer_price": 0,
        "rate": 0,
        "is_rate": false,
        "images": [],
        "category": {
            "id": 490,
            "reference_id": "12",
            "order_by": null,
            "name": "test",
            "name_ar": "test",
            "description": null,
            "icon": "",
            "store_id": "572",
            "parent_id": null,
            "deleted_at": null,
            "created_at": "2020-10-21 08:43:39",
            "updated_at": "2020-10-21 08:43:39",
            "icon32": ""
        },
        "merchant": {
            "id": 572,
            "username": "أسواق اليحيى",
            "email": "yahyamarkeet@gmail.com",
            "email_verified_at": null,
            "mobile": "0567116377",
            "new_mobile": null,
            "country_code_length": 4,
            "is_confirm_code": 0,
            "city_id": 12,
            "address": null,
            "latitude": null,
            "longitude": null,
            "image": null,
            "type": "merchant",
            "is_active": 1,
            "has_delivery": 0,
            "is_driver_available": 1,
            "bio": null,
            "driver_type_id": null,
            "is_reset_password": 0,
            "commission_rate": 0,
            "refund_commission_rate": 0,
            "lang": "en",
            "api_key": "F86C39B4289E5D7EA1FAC66C3234A",
            "deleted_at": null,
            "created_at": "2020-09-26 17:53:46",
            "updated_at": "2020-10-01 12:24:22",
            "service_rate": null,
            "count_pending_request": null,
            "count_accepted_request": null,
            "count_rejected_request": null,
            "count_finished_request": null,
            "services": null,
            "reviews": null,
            "city": {
                "id": 12,
                "name_ar": "الهفوف",
                "name_en": "Al Hufuf",
                "deleted_at": null,
                "created_at": null,
                "updated_at": null
            },
            "image100": null,
            "image300": null,
            "vehicle": null,
            "min_merchant_price": 200,
            "count_order_sent": 0,
            "count_product_sent": 0,
            "total_revenue": 0,
            "store_images": [],
            "merchant_products": null,
            "store": {
                "id": 124,
                "merchant_id": 572,
                "name": "أسواق اليحيى",
                "description": null,
                "lat": null,
                "lng": null,
                "phone": null,
                "deleted_at": null,
                "created_at": "2020-09-26 17:53:46",
                "updated_at": "2020-09-26 17:53:46",
                "categories": [
                    {
                        "id": 11,
                        "reference_id": null,
                        "order_by": 1,
                        "name": "Supermarket",
                        "name_ar": "التموينات",
                        "description": null,
                        "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                        "store_id": null,
                        "parent_id": null,
                        "deleted_at": null,
                        "created_at": "2019-06-14 13:18:40",
                        "updated_at": "2020-09-17 08:36:22",
                        "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                        "pivot": {
                            "store_id": 124,
                            "category_id": 11
                        }
                    }
                ],
                "drivers": []
            },
            "merchant_categories": [
                {
                    "id": 11,
                    "reference_id": null,
                    "order_by": 1,
                    "name": "Supermarket",
                    "name_ar": "التموينات",
                    "description": null,
                    "icon": "http://localhost/Dragon/storage/app/categories/11/111599637994.png",
                    "store_id": null,
                    "parent_id": null,
                    "deleted_at": null,
                    "created_at": "2019-06-14 13:18:40",
                    "updated_at": "2020-09-17 08:36:22",
                    "icon32": "http://localhost/Dragon/storage/app/categories/11/32/111599637994.png",
                    "pivot": {
                        "store_id": 124,
                        "category_id": 11
                    }
                }
            ],
            "order_bought": null,
            "order_pending": null,
            "order_canceled": null,
            "shipments": [
                {
                    "id": 2,
                    "merchant_id": null,
                    "price": 15,
                    "from": 0,
                    "to": 10,
                    "type": "admin",
                    "min_order_amount": 0,
                    "deleted_at": null,
                    "created_at": "2020-08-20 14:10:20",
                    "updated_at": "2020-08-20 14:11:42"
                }
            ],
            "has_merchant_driver": 0,
            "has_dragonmart_driver": 0,
            "has_freelancer_driver": 0,
            "driver_follow_type": 0,
            "driver_type": null,
            "unseen_notifications": 0
        },
        "customizations": [],
        "order_count": 0
    }
}
 </code>

       </pre>
      </div>
    </div>


  </section>
</article>




			    <footer class="footer">
				    <div class="container text-center py-5">
					    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				        <small class="copyright">Dragon Mart</small>
				    </div>
			    </footer>
		    </div>
	    </div>
    </div><!--//docs-wrapper-->



    <!-- Javascript -->
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/plugins/popper.min.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Page Specific JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/js/highlight-custom.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/plugins/jquery.scrollTo.min.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/plugins/lightbox/dist/ekko-lightbox.min.js"></script>
    <script src="<?php echo e(url('resources/views/apiDocs/')); ?>/assets/js/docs.js"></script>

</body>
</html>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/apiDocs/index.blade.php ENDPATH**/ ?>