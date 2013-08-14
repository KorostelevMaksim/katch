<?get_header()?>
<a href="<?=__BASEURL__.getModule().'/add/'?>" class="btn btn-success">Add</a>
<?
    global $db;
    
    $db->query('SELECT * FROM Post');
    $db->debug();
    
?>
<?get_footer()?>