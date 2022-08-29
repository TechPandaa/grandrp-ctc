<?php 

// Initialize the language-module
$_language->read_module('homepage');

?>
<div class="container search flex flex-nowrap flex-column flex-justify-center flex-align-center">
    <form id="search" action="index.php?site=search" method="post">
        <label for="search"><?php echo $_language->module['search_your_car']; ?></label>
        <input type="text" name="search" placeholder="18performante"/>
        <div id="buttons">
            <input class="uppercase" type="submit" value="<?php echo $_language->module['show_me_the_money']; ?>" />
            <a class="button secondary" href="https://gta5grand.com/?ref=19246" target="_blank"><?php echo $_language->module['what_is_grand']; ?></a>
        </div>
    </form>
    <div>
        <div class="728">
            
        </div>
    </div>
</div>