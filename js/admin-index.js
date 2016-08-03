var btnEdit;

window.onload = function() {
	btnEdit = document.getElementById('edit-contest');

	btnEdit.addEventListener("click", function() {
		var items = document.getElementsByClassName('sel');
		var selectedItem;

		for (var i = 0; i < items.length; i++) {
			if(items[i].checked == true)
				selectedItem = items[i];
		};

		if(selectedItem != undefined)
			window.location = "edit-contest.php?id=" + selectedItem.value;
	})
}