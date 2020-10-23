<?php 
 include('header.php');
 include('nav-bar.php');
?>
<!-- ################################################################################################ -->
<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
  <div class="overlay">
    <div id="breadcrumb" class="clear"> 
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="<?php echo FRONT_ROOT ?>Home/Index">Add</a></li>
        <li><a href="<?php echo FRONT_ROOT ?>Cellphone/ListCellphone">List - Remove</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
        <?php if(isset($message)){ ?>
                    <label class="text-white" for=""> <strong> <?php echo $message ?> </strong> </label>
               <?php } ?>
      <form action="<?php echo FRONT_ROOT ?>Cellphone/RemoveCellphone" method="POST">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style="width: 15%;">Code</th>
              <th style="width: 30%;">Brand</th>
              <th style="width: 30%;">Model</th>
              <th style="width: 15%;">Price</th>
              <th colspan="2" style="width: 5%;">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($listCellphone as $cellphone) {  ?>
            <tr>
                <td><?php echo $cellphone->getCode(); ?></td>
                <td><?php echo $cellphone->getBrand(); ?></td>
                <td><?php echo $cellphone->getModel(); ?></td>
                <td><?php echo $cellphone->getPrice(); ?></td>
                <td>
                  <button type="submit" name="id_remove" class="btn" value="<?php echo $cellphone->getIdCellphone(); ?>"> Remove </button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table></form>
        <form action="<?php echo FRONT_ROOT ?>Cellphone/ShowUpdateCellphoneView" method="POST">
        <table style="text-align:center;">
          <thead>
            <tr>
              <th style="width: 15%;">Ingrese el codigo del telefono a borrar</th>
              <th style="width: 15%;">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td> <input type="number" value="" name="codeToBorrar" placeholder="123">  </input> </td>
                <td>
                  <button type="submit" name="code_update" class="btn" value=""> UPDATE </button>
                </td>
              </tr>
          </tbody>
        </table></form>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
  include('footer.php');
?>