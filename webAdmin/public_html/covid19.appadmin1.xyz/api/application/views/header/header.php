
  
    <style>
      @keyframes hideLoader{
            0%{ width: 100%; height: 100%; }
            100%{ width: 0; height: 0; }
        }
        body > div.loader{
                position: fixed;
                background: white;
                width: 100%;
                height: 100%;
                z-index: 1071;
                opacity: 0;
                transition: opacity .5s ease;
                overflow: hidden;
                pointer-events: none;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            body:not(.loaded) > div.loader{
                opacity: 1;
            }
            body:not(.loaded){
                overflow: hidden;
            }
        body.loaded > div.loader{
            animation: hideLoader .5s linear .5s forwards;
        }

        /* Typing Animation */
    .loading-animation {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      animation: typing 1s linear infinite alternate;
      position: relative;
      left: -12px;
    }

    @keyframes typing {
      0% {
        background-color: rgba(100,100,100, 1);
        box-shadow: 12px 0px 0px 0px rgba(100,100,100, 0.2),
          24px 0px 0px 0px rgba(100,100,100, 0.2);
      }

      25% {
        background-color: rgba(100,100,100, 0.4);
        box-shadow: 12px 0px 0px 0px rgba(100,100,100, 2),
          24px 0px 0px 0px rgba(100,100,100, 0.2);
      }

      75% {
        background-color: rgba(100,100,100, 0.4);
        box-shadow: 12px 0px 0px 0px rgba(100,100,100, 0.2),
          24px 0px 0px 0px rgba(100,100,100, 1);
      }
    }
	
	
	
	
	/*----------------Gradient Normal color------------------*/
	.grad-color, .grad-color-nohover{
	
		background: -webkit-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -o-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -ms-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -moz-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: linear-gradient(110deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;

	}
	
	.grad-color-transparent{
			transition:none!important;
	}
	
	.grad-color-transparent:hover{
		
		background: -webkit-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -o-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -ms-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: -moz-linear-gradient(340deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		background: linear-gradient(110deg, rgb(126, 92, 241) 0%, rgb(50, 136, 245) 73%, rgb(1, 144, 248) 93%, rgb(1, 151, 248) 100%)!important;
		color:#fff!important;
		text-align:center;
	}
	
	.grad-color:hover{
		background: -webkit-linear-gradient(340deg, rgb(111, 74, 234) 0%, rgb(43, 126, 233) 73%, rgb(29, 147, 233) 93%, rgb(0, 136, 223) 100%)!important;
		background: -o-linear-gradient(340deg, rgb(111, 74, 234) 0%, rgb(43, 126, 233) 73%, rgb(29, 147, 233) 93%, rgb(0, 136, 223) 100%)!important;
		background: -ms-linear-gradient(340deg, rgb(111, 74, 234) 0%, rgb(43, 126, 233) 73%, rgb(29, 147, 233) 93%, rgb(0, 136, 223) 100%)!important;
		background: -moz-linear-gradient(340deg, rgb(111, 74, 234) 0%, rgb(43, 126, 233) 73%, rgb(29, 147, 233) 93%, rgb(0, 136, 223) 100%)!important;
		background: linear-gradient(110deg, rgb(111, 74, 234) 0%, rgb(43, 126, 233) 73%, rgb(29, 147, 233) 93%, rgb(0, 136, 223) 100%)!important;

	}
	
	.grad-color:focus,.grad-color:active{
		background: -webkit-linear-gradient(340deg, rgb(98, 63, 216) 0%, rgb(45, 119, 212) 73%, rgb(0, 124, 214) 93%, rgb(0, 133, 219) 100%)!important;
		background: -o-linear-gradient(340deg, rgb(98, 63, 216) 0%, rgb(45, 119, 212) 73%, rgb(0, 124, 214) 93%, rgb(0, 133, 219) 100%)!important;
		background: -ms-linear-gradient(340deg, rgb(98, 63, 216) 0%, rgb(45, 119, 212) 73%, rgb(0, 124, 214) 93%, rgb(0, 133, 219) 100%)!important;
		background: -moz-linear-gradient(340deg, rgb(98, 63, 216) 0%, rgb(45, 119, 212) 73%, rgb(0, 124, 214) 93%, rgb(0, 133, 219) 100%)!important;
		background: linear-gradient(110deg, rgb(98, 63, 216) 0%, rgb(45, 119, 212) 73%, rgb(0, 124, 214) 93%, rgb(0, 133, 219) 100%)!important;

	}
	/*End----------------Gradient Normal color------------------*/
	
	
	
	/*-------------------*Gradient contrast color-----------------*/
	.grad-contrast{
		background: -webkit-linear-gradient(340deg, rgb(254, 149, 94) 0%, rgb(255, 196, 73) 71%, rgb(248, 191, 60) 100%);
background: -o-linear-gradient(340deg, rgb(254, 149, 94) 0%, rgb(255, 196, 73) 71%, rgb(248, 191, 60) 100%);
background: -ms-linear-gradient(340deg, rgb(254, 149, 94) 0%, rgb(255, 196, 73) 71%, rgb(248, 191, 60) 100%);
background: -moz-linear-gradient(340deg, rgb(254, 149, 94) 0%, rgb(255, 196, 73) 71%, rgb(248, 191, 60) 100%);
background: linear-gradient(110deg, rgb(254, 149, 94) 0%, rgb(255, 196, 73) 71%, rgb(248, 191, 60) 100%);

	}
	
	.grad-contrast:hover, .btn-transparent:hover{
		background: -webkit-linear-gradient(340deg, rgb(255, 139, 79) 0%, rgb(249, 187, 57) 71%, rgb(225, 172, 51) 100%);
background: -o-linear-gradient(340deg, rgb(255, 139, 79) 0%, rgb(249, 187, 57) 71%, rgb(225, 172, 51) 100%);
background: -ms-linear-gradient(340deg, rgb(255, 139, 79) 0%, rgb(249, 187, 57) 71%, rgb(225, 172, 51) 100%);
background: -moz-linear-gradient(340deg, rgb(255, 139, 79) 0%, rgb(249, 187, 57) 71%, rgb(225, 172, 51) 100%);
background: linear-gradient(110deg, rgb(255, 139, 79) 0%, rgb(249, 187, 57) 71%, rgb(225, 172, 51) 100%);

	}
	
	.grad-contrast:focus, .grad-contrast:active, .btn-transparent:focus, .btn-transparent:active{
		background: -webkit-linear-gradient(340deg, rgb(249, 135, 75) 0%, rgb(233, 174, 51) 71%, rgb(248, 202, 98) 100%);
background: -o-linear-gradient(340deg, rgb(249, 135, 75) 0%, rgb(233, 174, 51) 71%, rgb(248, 202, 98) 100%);
background: -ms-linear-gradient(340deg, rgb(249, 135, 75) 0%, rgb(233, 174, 51) 71%, rgb(248, 202, 98) 100%);
background: -moz-linear-gradient(340deg, rgb(249, 135, 75) 0%, rgb(233, 174, 51) 71%, rgb(248, 202, 98) 100%);
background: linear-gradient(110deg, rgb(249, 135, 75) 0%, rgb(233, 174, 51) 71%, rgb(248, 202, 98) 100%);

	}
	
	/*End-------------------*Gradient contrast color-----------------*/
	
	nav{
		-webkit-transition:padding 0.2s ease!important;
		transition:padding 0.2s ease!important;
		/*border-bottom:1px solid #eee!important;*/
	}
	
	footer{
		padding-top: 40px!important;
		border-top:1px solid #eee!important;
	}
	
	nav.scrolled{
		padding-top:0px;
		padding-bottom:0px;
	}
	
	.navbar {
		padding: 6px 5px;
	}
	
    </style>
    <script type="text/javascript">
      window.addEventListener("load", function () {
        document.querySelector('body').classList.add('loaded');
      });
    </script>
    <link href="<?php echo site_url("assets/"); ?>assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
   
  </head>

  <body>
    <div class="loader">
      <div class="loading-animation"></div>
    </div>
    
    <div class="navbar-container ">
  <nav class="navbar navbar-expand-lg justify-content-between navbar-light bg-white" data-sticky="top">
    <div class="container-fluid">
      <div class="col flex-fill px-0 d-flex justify-content-between"> 
      
      <a class="navbar-brand mr-0 fade-page" href="<?php echo $this->config->item("front_url"); ?>"> <img src="<?php echo site_url("assets/"); ?>assets/img/monopolion_logo_12.svg" alt="Monopolion" width="210"> </a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-label="Toggle navigation"> <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 17C3 17.5523 3.44772 18 4 18H20C20.5523 18 21 17.5523 21 17V17C21 16.4477 20.5523 16 20 16H4C3.44772 16 3 16.4477 3 17V17ZM3 12C3 12.5523 3.44772 13 4 13H20C20.5523 13 21 12.5523 21 12V12C21 11.4477 20.5523 11 20 11H4C3.44772 11 3 11.4477 3 12V12ZM4 6C3.44772 6 3 6.44772 3 7V7C3 7.55228 3.44772 8 4 8H20C20.5523 8 21 7.55228 21 7V7C21 6.44772 20.5523 6 20 6H4Z"
                fill="#212529" />
        </svg> </button>
      </div>
      <div class="collapse navbar-collapse col px-0 px-lg-2 flex-fill" style="overflow: visible!important;">
        <div class="py-2 py-lg-0">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php echo $this->config->item("documentation_url"); ?>">API Documentation</a>
              
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php echo site_url("show/xmlDocumentation"); ?>">XML Documentation</a>
              
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php echo site_url("show/propfacilities"); ?>" data-section="userfriendly_section">Facilities</a>
              
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php echo site_url("show/mobilecountrycode"); ?>" data-section="integration_section">Country Codes</a>
              
            </li>
            
             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php echo site_url("show/countries"); ?>" data-section="integration_section">Countries</a>
              
            </li>
            
            <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle scrollspy" href="<?php //echo site_url("#advantages_section"); ?>" data-section="advantages_section">Advantages</a>
              
            </li>-->
            
           
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse justify-content-end col flex-fill px-0"> <a href="<?php echo $this->config->item("front_url")."signin"; ?>" class="btn border">Log In</a> 
      <a href="<?php echo $this->config->item("front_url")."signup"; ?>" class="m-1 btn border btn-primary grad-color">14 Days Trial</a> </div>
    </div>
  </nav>
</div>