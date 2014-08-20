
<?php
if($bugs->count() > 0){
?>
    <table class="ui small table segment">
    <thead>
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Operations</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($bugs as $bug){
    ?>
    <tr>
        <td><?php echo $bug->title;?></td>
        <td><?php echo $bug->status->get()->name; ?></td>
        <td>
            <a href="<?php echo site_url('bugs/edit/'.$bug->id); ?>"><i class="edit sign icon linked" title="Edit/Details"></i></a>
            |
            <a href="<?php echo site_url('bugs/delete/'.$bug->id); ?>"><i class="remove circle icon linked" title="Delete"></i></a>
        </td>
    <tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3"></th>
    </tr>
    </tfoot>
    <table>
<?php
}else{
    echo "<div class='ui visible message small yellow'>No submitted bugs</div>";
}
?>