<div class="modal fade" id="AlcoolCalculate" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $converter?></h4>
        </div>
	        <div class="modal-body">
		        <div class="panel-body">
			        <div class="form-group  col-xs-12 col-sm-3">
			        	<label>Original grivity</label><input id="og" class="form-control" value="" onchange="getAlcool()">
			        </div>
			        <div class="form-group  col-xs-12 col-sm-3">
			        	<label>Final grivity</label><input id="fg" class="form-control" value="" onchange="getAlcool()">
			        </div>
			        <div class="form-group col-xs-12 col-sm-12">
			        	<label>Alcool</label><input name="alcool" id="alcool" class="form-control" value="">
		        	</div>
			        <div class="form-group col-xs-12 col-sm-12">
		        		<button type="submit" class="btn btn-default"><?php echo $apply;?> - Alcool</button>
		        	</div>
		        </div>
		    </div>
		 </div>
    </div>
 </div>