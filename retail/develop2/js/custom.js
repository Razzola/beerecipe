function getProducts(ingNameEle){
	debugger;
	var prodNameEle=ingNameEle.replace('ingredient','product');
	
	var selectedIngredient = document.getElementsByName(ingNameEle)[0];
	var selectProduct =  document.getElementsByName(prodNameEle)[0];
	
    for (var i = 0; i < selectProduct.length; i++) {
        var val = selectProduct.options[i].value;
    	var productIngredient = val.split("|");
    	var include = false;
    	if (selectedIngredient==productIngredient[1])
        	var include = true;
        selectProduct.options[i].style.display = include ? 'list-item':'none';
    }
	
}
function setPrice(){
	var selectedIngredient = document.getElementsByName("product")[0].value;
	var getPrice = selectedIngredient.split("|")[2];
	var eleProduct = document.getElementsByName("price")[0];
	eleProduct.value = getPrice;
	
}

function addRow(text){
	debugger;
	var eleForm = document.getElementsByName("otherIng")[0];
	var newIng = text.replace('<select class="form-control" name="ingredient0" onchange="getProducts("ingredient0")">','<select class="form-control" name="ingredient1" onchange="getProducts("ingredient1")">')
	eleForm.innerHTML +=  newIng ;
	
}

/*
function getPrice(){
	var selectedProduct = document.getElementsByName("product")[0].value;
    	var productIngredient = val.split("|");
    	var include = false;
    	if (selectedProduct==productIngredient[1])
        	var include = true;
        selectProduct.options[i].style.display = include ? 'list-item':'none';
    }
	
}*/


jQuery.fn.filterByText = function(textbox) {
    return this.each(function() {
        var select = this;
        var options = [];
        $(select).find('option').each(function() {
            options.push({value: $(this).val(), text: $(this).text()});
        });
        $(select).data('options', options);

        $(textbox).bind('change keyup', function() {
            var options = $(select).empty().data('options');
            var search = $.trim($(this).val());
            var regex = new RegExp(search,"gi");

            $.each(options, function(i) {
                var option = options[i];
                if(option.text.match(regex) !== null) {
                    $(select).append(
                        $('<option>').text(option.text).val(option.value)
                    );
                }
            });
        });
    });
};