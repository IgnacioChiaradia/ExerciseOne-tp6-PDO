<?php 
 include('header.php');
 include('nav-bar.php');

 //echo '<pre>';
 //var_dump($cellphoneSearch);
 //echo '<pre>';
 //die();
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
<main class="container clear"> 
    <div class="content"> 
      <div id="comments" >
        <h2>UPDATE CELLPHONE</h2>
        <form action="<?php echo FRONT_ROOT ?>Cellphone/UpdateCellphone" method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>
              <tr>
                <th>Code</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <input type="hidden" name="id" value="<?php echo $cellphoneSearch->getIdCellphone(); ?>">
                <td style="max-width: 100px;">
                  <input type="number" name="code" min="1" max="999" size="30" value="<?php echo $cellphoneSearch->getCode(); ?>" required>
                </td>
                <td>
                  <input type="text" name="brand" size="20" value="<?php echo $cellphoneSearch->getBrand(); ?>" required>
                </td>
                <td>
                  <input type="text" name="model" size="20" value="<?php echo $cellphoneSearch->getModel(); ?>" required>
                </td>     
                <td>
                  <input type="text" name="price" size="10" value="<?php echo $cellphoneSearch->getPrice(); ?>" required>
                </td>         
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Editar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
<!-- ################################################################################################ -->

<?php 
  include('footer.php');
?>