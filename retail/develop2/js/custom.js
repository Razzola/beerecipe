var count = 1
var aauIndex = 28

function addAAUField(){
    var ingredientControl = document.getElementsByName("ingredient")[0];
    var selectedIngredient = ingredientControl.value;
    var AAU=document.getElementsByName("aauContainer")[0];
    if (selectedIngredient == 2 || selectedIngredient == 3)
        AAU.style.display="block";
    else
        AAU.style.display="none";
}
function getProducts(ingNameEle){
	var prodNameEle=ingNameEle.replace('ingredient','product');
	
	var selectedIngredient = document.getElementsByName(ingNameEle)[0];
	var selectProduct =  document.getElementsByName(prodNameEle)[0];
	
    for (var i = 0; i < selectProduct.length; i++) {
        var val = selectProduct.options[i].value;
    	var productIngredient = val.split("|");
    	var include = false;
    	if (selectedIngredient.value==productIngredient[1])
        	var include = true;
        selectProduct.options[i].style.display = include ? 'list-item':'none';
    }
	
}
function setPrice(prodNameEle){
	var selectedProduct = document.getElementsByName(prodNameEle)[0].value;
	var getPrice = selectedProduct.split("|")[2];
	var priceNameEle=prodNameEle.replace('product','price');
	var eleProduct = document.getElementsByName(priceNameEle)[0];
	eleProduct.value = getPrice;
	
}

function setLinkToSticker(){
	var stickersize = parseInt(document.getElementById("stickersize").value);
	document.getElementById("linkToSticker").setAttribute('href',document.getElementById("linkToSticker").getAttribute('href')+"&size="+stickersize);
}

function addRow(text){
	var eleForm = document.getElementsByName("otherIng")[0];
	var newIng = text.replace('ingredient','ingredient'+count);
	newIng = newIng.replace('product','product'+count);
	newIng = newIng.replace('price','price'+count);
	newIng = newIng.replace('quantity','quantity'+count);
	newIng = newIng.replace('getProducts(\'ingredient\')','getProducts(\'ingredient'+count+'\')');
	newIng = newIng.replace('<label>Ingredient</label>','');
	newIng = newIng.replace('<label>Product</label>','');
	newIng = newIng.replace('<label>Quantity</label>','');
	newIng = newIng.replace('<label>Price</label>','');
	eleForm.outerHTML +=  newIng ;
	count++;
}

function getGrams(){
	var aau = parseInt(document.getElementById("aau").value);
	var aah = parseInt(document.getElementById("aah").value);
	var lt = parseInt(document.getElementById("lt").value);
	var gramsControl = document.getElementById("grams");
	if ((aau>0)&& (aah>0)&& (lt>0)){
		var grams = setGrams(aau,aah,lt);
		gramsControl.setAttribute('value',grams);
	}
}


function setGrams(aah,aau,lt){
	//puts calcules here
	return aau+aah+lt;
}

function poundToGrams(pound){
	return pound*28,34;
}

function gramsToPound(grams){
	return grams/28,34;
}

function getIBU(){
	var aah = parseInt(document.getElementById("aah_ibu").value);
	var lt = parseInt(document.getElementById("lt_ibu").value);
	var time = parseInt(document.getElementById("time_ibu").value);
	var grams = parseInt(document.getElementById("grams_ibu").value);
	var ibuControl = document.getElementById("ibu");
	console.log("aah="+aah+" lt="+lt+" time="+time+" grams="+grams);
	if ((aah>0) && (time>0)&&(lt>0) && (grams>0)){
			var ibu = setIBU(time,aah,lt,grams);
			ibuControl.setAttribute('value',ibu);
	}
	
}

function setIBU(time,aah,lt,grams){
	return (grams*aah*time)/(10*lt)
}


function getAlcool(){
	var og = parseInt(document.getElementById("og").value);
	var fg = parseInt(document.getElementById("fg").value);
	var alcoolControl = document.getElementById("alcool");
	console.log("og="+og+" fg="+fg);
	if ((og>0) && (fg>0)){
			var alcool = setAlcool(og,fg);
			alcoolControl.setAttribute('value',alcool);
	}

}

function setAlcool(og,fg){
	return Math.round((og-fg)/7.5*10)/10;
}

document.getElementById('deletelink').onclick = function() { 
	var r = confirm("Are you sure to delete the data?");
	if (r == false) {
		return false; 
		}
};


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