<div class="main_content pt-0">
<div class="create_room">
    <div class="row mb-4">
        <?php 
            $i = 0;
            $tab_class = $style = '';
            foreach($tab_name as $tab_key=>$tab_value){
                if($i==0){
                    $tab_class = "tab-active";
                    $style = "border-top-left-radius:16px;";
                    $i++;
                }else{
                    $tab_class = '';
                    $style = 'border-top-right-radius:16px;';
                }
        ?>
            <div class="col <?php echo $tab_class; ?> tab-btns" data-id=".<?php echo $tab_key; ?>" style="<?php echo $style; ?>">
                <h4 class="super-center text-center p-2"><?php echo $tab_value; ?></h4>
            </div>
        <?php
            }
        ?>
    </div>
    <?php foreach($tab_content as $data_key=>$data_value){ ?>
    <div class="<?php echo $data_key;?> tab-content">
        <form action="" method="POST">
            <div class="control3"> 
                <?php foreach($data_value['form_fields'] as $input_key=>$input_value){
                    if($input_value['type']!='submit' and $input_value['type']!='select'){?>
                <div class="lb">
                    <span id="room_name" class="f">
                        <label for="<?php echo $input_value['id'];?>"><?php echo $input_value['label'];?></label>
                    </span>
                    <span class="f">
                        <input type="<?php echo $input_value['type'];?>" class="cun" id="<?php echo $input_value['id'];?>" name="<?php echo $input_value['name'];?>"> 

                    </span> 
                </div>
                <?php }else if($input_value['type']=='select'){
                    ?>
                    <div class="lb">
                        <span id="room_name" class="f">
                            <label for="<?php echo $input_value['id'];?>"><?php echo $input_value['label'];?></label>
                        </span>
                        <span class="f">
                            <select name="<?php echo $input_value['name'];?>" id="<?php echo $input_value['id'];?>" hidden>
                                <?php foreach($input_value['value'] as $option_key=>$option_value){ ?>
                                    <option value="<?php echo $option_key; ?>"><?php echo $option_value; ?></option>
                                <?php }?>
                            </select>
                            <?php 
                            $option_index = 1;
                            foreach($input_value['value'] as $option_key=>$option_value){ ?>
                                <button id="move-blue<?php echo $option_index; ?>" data-value="<?php echo $option_key; ?>" class="players playersel bg-<?php echo $option_key; ?>"></button>&nbsp;&nbsp;&nbsp;
                                <?php
                                $option_index++;
                            }
                            ?>
                        </span> 
                    </div>
                <?php } }?>
            </div>
            <div class="super-center">
            <?php foreach($data_value['form_fields'] as $input_key=>$input_value){
                    if($input_value['type']=='submit'){?>                    
                    <input type="<?php echo $input_value['type'];?>" name="<?php echo $input_value['name'];?>" class="main_btns" id="<?php echo $input_value['id'];?>" value="<?php echo $input_value['label'];?>">
                    <?php } }?>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
</div>