<div class="modal fade" id="bitterCalculate" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $converter?></h4>
        </div>
        <div class="modal-body">
	        <div class="panel-body">
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>AAU recipe</label><input id="aau" class="form-control" value="" onchange="getGrams()">
		        </div>	
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>Alfa Acid Hop</label><input id="aah" class="form-control" value="" onchange="getGrams()">
		        </div>	
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>Liter</label><input id="lt" class="form-control" value="" onchange="getGrams()">
		        </div>
		        <div class="form-group col-xs-12 col-sm-3">
		        	<label>Grams</label><input id="grams" class="form-control" value="">
	        	</div>
	        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
 </div>
 
 
<div class="modal fade" id="IBUCalculate" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $converter?></h4>
        </div>
	        <div class="modal-body">
		        <div class="panel-body">
		        	<div class="form-group col-xs-12 col-sm-3">
			        	<label>Time</label>
	                    <select class="form-control" id="time_ibu" onchange="getIBU()">
		                   	<option value="">Select time</option>
		                   	<option value="5">0-5 mins</option>
		                   	<option value="7">6 - 10 mins</option>
							<option value="8">11 - 15 mins</option>
							<option value="10,1">16 - 20 mins</option>
							<option value="12,1">21 - 25 mins</option>
							<option value="15,3">26 - 30 mins</option>
							<option value="18,8">31 - 35 mins</option>
							<option value="22,8">36 - 40 mins</option>
							<option value="26,9">41 - 45 mins</option>
		                </select>
		            </div>
			        <div class="form-group  col-xs-12 col-sm-3">
			        	<label>Alfa Acid Hop</label><input id="aah_ibu" class="form-control" value="" onchange="getIBU()">
			        </div>	
			        <div class="form-group  col-xs-12 col-sm-3">
			        	<label>Liter</label><input id="lt_ibu" class="form-control" value="" onchange="getIBU()">
			        </div>
			        <div class="form-group col-xs-12 col-sm-3">
			        	<label>Grams</label><input id="grams_ibu" class="form-control" onchange="getIBU()">
		        	</div>
			        <div class="form-group col-xs-12 col-sm-12">
			        	<label>IBU</label><input name="ibu" id="ibu" class="form-control" value="">
		        	</div>
			        <div class="form-group col-xs-12 col-sm-12">
		        		<button type="submit" class="btn btn-default"><?php echo $apply;?> - IBU</button>
		        	</div>
		        </div>
    </div>
 </div>
      
 <script src="js/custom.js"></script>