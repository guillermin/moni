$(document).ready(function() {
	$(":button").button();
	$("input[name=balance]").maskMoney();
	$("input[name=datetime]").datetimepicker({
		firstDay: 1,
		dateFormat: "yy/mm/dd",
		timeFormat: "hh:mm",
		stepMinute: 15,
	});
	$(".toplevel").click(function() {
		$(this).nextUntil(".toplevel", ".subgroup").toggle();
	});
	for (i=0; i<$("#origins ul li").size()-1; i++) {
		prep('org_'+i);
	}
	for (i=0; i<$("#destinations ul li").size()-1; i++) {
		prep('dst_'+i);
	}
	$("button[name=add_origin]").click(function() {
		var id = 'org_'+$(this).parent("li").index();
		var clone = $("#options #equity").clone();
		var html = '<span id="'+id+'_type"><input type="radio" id="'+id+'_type1" name="'+id+'_type" value="source" /><label for="'+id+'_type1">Source</label><input type="radio" id="'+id+'_type2" name="'+id+'_type" value="equity" checked="checked" /><label for="'+id+'_type2">Equity</label></span><span id="'+id+'" controller="equity">'+clone.html()+'<select></select><input type="text" name="amount" value="0.00" /></span><span id="'+id+'_delete" class="deletex">x</span>';
		$(this).parent("li").before('<li>'+html+'</li>');
		prep(id);
		load_sublvls(id);
	});
	$("button[name=add_destination]").click(function() {
		var id = 'dst_'+$(this).parent("li").index();
		var clone = $("#options #equity").clone();
		var html = '<span id="'+id+'_type"><input type="radio" id="'+id+'_type1" name="'+id+'_type" value="equity" checked="checked" /><label for="'+id+'_type1">Equity</label><input type="radio" id="'+id+'_type2" name="'+id+'_type" value="drain" /><label for="'+id+'_type2">Drain</label></span><span id="'+id+'" controller="equity">'+clone.html()+'<select></select><input type="text" name="amount" value="0.00" /></span><span id="'+id+'_delete" class="deletex">x</span>';
		$(this).parent("li").before('<li>'+html+'</li>');
		prep(id);
		load_sublvls(id);
	});
	$("form").submit(function() {
		if ($("input[name=timestamp]").length) {
			var d = new Date($("input[name=datetime]").val());
			$("input[name=timestamp]").val(d.getTime()/1000);
		}
		if ($("input[name=balance]").length) {
			$("input[name=balance]").val($("input[name=balance]").val().replace(/[^0-9]/g, ''));
		}
		if ($("input[name=parent_id]").length && $("input[name=parent_id]").val() == 0) {
			$("input[name=parent_id]").remove();
		}
  		for (i=0; i<$("#origins ul li").size()-1; i++) {
  			$("#org_"+i+" input[type=text]").val($("#org_"+i+" input[type=text]").val().replace(/[^0-9]/g, ''));
  			if ($("#org_"+i+" input[type=text]").attr('name').substr(0,9) == 'transfers') {
  				$("#org_"+i+" input[type=text]").val(- $("#org_"+i+" input[type=text]").val());
  			}
		}
		for (i=0; i<$("#destinations ul li").size()-1; i++) {
  			$("#dst_"+i+" input[type=text]").val($("#dst_"+i+" input[type=text]").val().replace(/[^0-9]/g, ''));
		}
	});
});

function prep(id) {
	$("#"+id+"_type").buttonset();
	$("#"+id+"_type :radio").change(function() {
		var controller = $(this).val();
		$("#"+id).attr('controller', controller);
		var clone = $("#options #"+controller).clone();
		$("#"+id+" select:first").replaceWith(clone.html());
		load_sublvls(id);
		$("#"+id+" select:first").change(function() {
			load_sublvls(id);
		});
	});
	$("#"+id+" select:first").change(function() {
		load_sublvls(id);
	});
	$("#"+id+" input[type=text]").maskMoney();
	$("#"+id+"_delete").click(function() {
		$(this).parent("li").html('');
	});
}

function load_sublvls(id) {
	var controller = $("#"+id).attr('controller');
	if (controller == 'source') var movement = 'incomes';
	else if (controller == 'equity') var movement = 'transfers';
	else if (controller == 'drain') var movement = 'expenses';
	var place = id.substr(0,1)+id.substr(4);
	var index = $("#"+id+" select:first").val();
	$.getJSON(base_url+controller+'/view/'+index+'.json', function(data) {
		$("#"+id+" select:last").attr('name', movement+'['+place+']['+controller+'_id]');
		var html = '<option value="'+index+'">Unspecified</option>';
		for(var i in data.children) {
			html += '<option value="'+data.children[i].id+'">'+data.children[i].name+'</option>';
		}
		$("#"+id+" select:last").html(html);
		$("#"+id+" input[type=text]").attr('name', movement+'['+place+'][amount]');
	});
}
