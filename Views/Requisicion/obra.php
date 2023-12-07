                     <?php echo $_REQUEST['id']; ?>
                     <div class="col-sm-4">
                         <div class="form-group">
                             <label>Obras</label>
                             <select class="form-control" onchange="Obras(this.value)" required>
                                 <?php $cliente = $this->model->Obras($_REQUEST['id'])?>
                                 <?php foreach ($cliente as $value): ?>
                                 <option value="<?php echo $value->id; ?>"><?php echo $value->razonsocial; ?>
                                 </option>
                                 <?php endforeach;?>
                             </select>
                         </div>
                     </div>