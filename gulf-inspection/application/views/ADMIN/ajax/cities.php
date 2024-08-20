<?php if(!empty($records)):?>
<?php foreach($records as $row):?>  
    <option value="<?php echo $row->id;?>" <?php echo (($row->id==$id)?'selected':'');?>><?php echo $row->name;?></option>  
<?php endforeach?>
<?php else:?>
    <option value="">cities not available</option>
<?php endif?>