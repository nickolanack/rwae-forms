<span class="group"><label>Year <input type="number" value=""
		name="admin-year" /></label><label class="pull-right">Quarter <input
		type="radio" value="1st" name="admin-quarter" /> 1st <input
		type="radio" value="2nd" name="admin-quarter" /> 2nd <input
		type="radio" value="3rd" name="admin-quarter" /> 3rd <input
		type="radio" value="4th" name="admin-quarter" /> 4th
</label>
<?php 
	$extQid='e-q-'.rand(1000,9999);
?>
<span id="<?php echo $extQid; ?>" class="ext-q">(Quarter 1 - 16) <?php 

for($i=0;$i<16;$i++){

	$y=2014;
	$q=2; //0, 1, 2, 3



	$quarter=(int)(($i+$q)%4);
	$year=(int) ($y+(($i+$q)/4));

	$quarterStrings=array('1st', '2nd', '3rd', '4th');

	$onclick='UIFormManager.setFormData({\'admin-year\':\''.$year.'\'}); ';
	$onclick.='UIFormManager.setFormData({\'admin-quarter\':\''.$quarterStrings[$quarter].'\'}); ';
	$onclick.='selectExtendedQuarterly(this); ';

	?><button data-yq="<?php echo $year.$quarterStrings[$quarter]; ?>" class="btn" onclick="<?php echo $onclick; ?>return false;"><?php echo $i+1; ?></button><?php 

}

?></span>

</span>

<script type="text/javascript">
	
	var selectExtendedQuarterly=function(button){

		
	};

	(function(id){



		var container=document.getElementById(id);
		var form=container.parentNode;
		while(form.tagName!=='FORM'){
			form=form.parentNode;
		}

		var updateSelected=function(){
			
			var data=UIFormManager.getFormData(form);
			var yrQuarterStr=data['admin-year']+data['admin-quarter'];

			//console.log('check update :'+yrQuarterStr);


			Array.prototype.slice.call(container.childNodes, 0).forEach(function(i) {
				if(i.tagName=='BUTTON'){
					if(i.getAttribute('data-yq')===yrQuarterStr){
						i.addClass('btn-primary');
					}else{
						i.removeClass('btn-primary');
					}
				}

			});

		};


		Array.prototype.slice.call(form, 0).forEach(function(i) {
			if(i.name=='admin-year'||i.name=='admin-quarter'){
				i.addEventListener('change',updateSelected); 
			}

		});


	})("<?php echo $extQid;?>");


</script>