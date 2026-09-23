 <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <!-- <a class="navbar-brand" href="#"><img style="filter: hue-rotate (50%)"alt="Brand" width="" height="35px" src="../../img/dtc.jpg"></a>-->
          <a class="navbar-brand" href="#">Manager S5</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if(isset($active0)){ echo $active0; } else { $active0 = ""; } ?> ><a href="index.php">Administrar Roles</a></li>
            <li <?php if(isset($active1)){ echo $active1; } else { $active1 = ""; } ?>><a href="servers.php">Servidores</a></li>
            <li <?php if(isset($active2)){ echo $active2; } else { $active2 = ""; } ?>><a href="ipsl.php">IPs Locales</a></li>
            <li <?php if(isset($active3)){ echo $active3; } else { $active3 = ""; } ?>><a href="dominios.php">Dominios</a></li>
            <li <?php if(isset($active4)){ echo $active4; } else { $active4 = ""; } ?>><a href="equipos.php">Equipos</a></li>
            <li <?php if(isset($active5)){ echo $active5; } else { $active5 = ""; } ?>><a href="chrome.php">Chromebooks</a></li>
            <!--<li <?php if(isset($active4)){ echo $active4; } else { $active4 = ""; } ?>><a href="masivo.php">Multiples Registros</a></li>-->
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Bienvenido  <?php $ufunc->UserName();  //Show name who is in session user?></a></li>
            <li ><a href="../../includes/logout.php">Cerrar Sesión</a></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>