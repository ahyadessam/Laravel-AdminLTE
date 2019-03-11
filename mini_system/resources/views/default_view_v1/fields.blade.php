<div class="form-group crud-group">
  @if(count($fields))
    <?php
    foreach($fields As $key=>$val){
      $input_label      = $key;
      $input_attributes = [];
      $input_class      = 'form-control ';
      $input_type       = 'text';
      $input_data       = [];
      $input_value      = null;

      if(isset($val['label']))
        $input_label = $val['label'];
      if(isset($val['attributes']))
        $input_attributes = $val['attributes'];
      if(isset($val['class']))
        $input_class .= $val['class'];
      if(isset($val['type']))
        $input_type = $val['type'];
      if(isset($val['select_data']))
        $input_data = $val['select_data'];
      if(isset($val['checkbox_data']))
        $input_data = $val['checkbox_data'];
      if(isset($val['value']))
        $input_value = $val['value'];


      if($input_type == 'hidden'){
        echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class], $input_attributes));
      }else{
        if(isset($val['new_line']) && $val['new_line'] == true){
          echo '</div><div class="form-group crud-group">';
        }

        echo '<div class="col-sm-6 col-xs-12 input-'.$input_type.'">';
        echo Form::label($key, ucfirst($input_label).' :');

        if(isset($val['datepicker']) && $val['datepicker'] == true){
          ?>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <?php
            echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class.' datepicker'], $input_attributes));
            ?>
          </div>
          <?php
        }else{
          if($input_type == 'select'){
            echo Form::select($key, $input_data, $input_value, array_merge(['class' => $input_class], $input_attributes));
          }else if($input_type == 'file'){
            $data_img = '';
            if(isset($row) && $row->{$key}){
              $data_img = url($update_path.'/'.$row->{$key});
            }
            echo '<input type="file" name="'.$key.'" value="" data-img="'.$data_img.'" />';
          }else if($input_type == 'checkbox'){
            echo Form::checkbox($key, (!empty($input_data))? $input_data : '1', $input_value, array_merge(['class' => $input_class], $input_attributes));
          }else{
            echo Form::{$input_type}($key, $input_value, array_merge(['class' => $input_class], $input_attributes));
          }
        }

        echo '</div>';
      }
    }
    ?>
  @endif
</div>

<!-- Submit Field -->
<div class="form-group">
  <div class="col-sm-12 text-center">
    {!! Form::submit(__('adminlte.submit'), ['class' => 'btn btn-success']) !!}
  </div>
</div>
