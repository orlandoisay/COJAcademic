var users = ["sazukerick","OrlandoIsay97","qaxnouxeb","Daves92","Andrei","Mac","Thanya1996","licgerman","Ozwaldo10","blade13","a_nonimo","juvencx","XeraXemag","cacoj","JoseMaria","gazperek","JLR","dassucht","JFJFV","Gabi","AngelLB","Herumancer","Contraband","Roberto666","Krinkelss","POOErikEstrada","Armando94","LopezSalvador","beristain","florezapc","puruandiro1994","GustavAdolf","Cachorro","GabrielRdgz","POOtyly","elizabethlml","Homer","zeuz_jaang","guickss","MigueJCP","Lupe","LosB18","Uncle Sam","susana","Statistics","Ruiz","Miguel9119","metpanblack","POOabonce","YesseniaLemus"];

var txtId, txtName, dtStart, dtEnd, txtProblem, txtUser, 
	btnAddProblem, btnAddUser, divOptions, btnCancel, btnCreate;

var vId = true,
	vName = true,
	vStart = true,
	vEnd = true;

function showMessage(msg, type, callback) {
	// TODO: Show visually the message inth bottom-right corner.
	callback();
}

function validateId() {
	txtId.style.borderColor = "rgba(255,255,255,0.1)";
}

function validateName() {
	if(txtName.value.length > 0) {
		vName = true;
		txtName.style.borderColor = "rgba(255,255,255,0.1)";
	}
	else {
		vName = false;
		txtName.style.borderColor = "rgba(255,0,0,0.5)";
	}
}

function validateStart() {
	if(dtStart.value.match(/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/g)) {
		vStart = true;
		dtStart.style.borderColor = "rgba(255,255,255,0.1)";
	}
	else {
		vStart = false;
		dtStart.style.borderColor = "rgba(255,0,0,0.5)";
	}
}

function validateEnd() {
	if(dtEnd.value.match(/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/g)) {
		vEnd = true;
		dtEnd.style.borderColor = "rgba(255,255,255,0.1)";
	}
	else {
		vEnd = false;
		dtEnd.style.borderColor = "rgba(255,0,0,0.5)";
	}
}

function validateProblem() {
	var problem = txtProblem.value;	
	txtProblem.value = problem.replace(/[^0-9]/g,'');
}

function validateUser() {
	var user = txtUser.value;
	txtUser.value = user.replace(/ /g,'');

	if(users.find(function(usr) { return usr == txtUser.value; }) != undefined) {
		hideOptions();
		return;
	}

	if(txtUser.value.length > 0) {
		showOptions(txtUser.value);
		return;
	}
	hideOptions();
}

function remove(elem) {
	elem.parentElement.removeChild(elem);
}

function addProblem(pid) {
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "api-problem.php?pid=" + pid);

	xhr.onload = function() {
		if(xhr.status == 200) {

			var data = JSON.parse(xhr.responseText);

			if(data.error != undefined)
				return;

			addProblemToList(pid, data.title);
		}
	}
	xhr.send();
}

function addProblemToList(pid,title) {
	var alreadyExists = false;
	var list = document.getElementsByClassName("list-container")[0];

	for (var i = 0; i < list.children.length; i++) 
		if(list.children[i].children[0].innerHTML == pid)
			alreadyExists = true;
	
	if(alreadyExists)
		return;

	var elem = document.createElement("DIV");
	elem.className = "list-elem";
	elem.innerHTML = "<h4>" + pid + " - " + title + "</h4>" +
					 "<button>&times;</button>";

	elem.children[1].addEventListener("click", function() {
		remove(elem);
	});

	list.appendChild(elem);
	txtProblem.value = "";
}

function setUserTo(usr) {
	txtUser.value = usr;
}

function showOptions(usr) {	
	divOptions.innerHTML = "";

	var matched = 0;

	for (var i = 0; i < users.length && matched < 5; i++) {
		if(users[i].toLowerCase().search(usr.toLowerCase()) != -1) {
			matched++;
			var li = document.createElement("LI");
			li.innerHTML = users[i];
			li.addEventListener("click", function() {
				setUserTo(this.textContent);
				hideOptions();
			});
			divOptions.appendChild(li);
		}
	}

	if(!matched)
		divOptions.innerHTML += "<li>No user was found.</li>";

	divOptions.style.display = "block";
}

function hideOptions() {
	divOptions.style.display = "none";
}

function addUser(usr) {
	if(users.find(function(usr) { return usr == txtUser.value; }) == undefined) 
		return;

	var alreadyExists = false;
	var list = document.getElementsByClassName("list-container")[1];

	for (var i = 0; i < list.children.length; i++) 
		if(list.children[i].children[1].innerHTML == usr)
			alreadyExists = true;
	
	if(alreadyExists)
		return;

	var elem = document.createElement("DIV");
	elem.className = "list-elem";
	elem.innerHTML = "<img src='http://coj.uci.cu/images/avatars/" + usr + "'>" + 
					 "<h4>" + usr + "</h4>" +
					 "<button>&times;</button>";

	elem.children[2].addEventListener("click", function() {
		remove(elem);
	});

	list.appendChild(elem);
	txtUser.value = "";
}

function createContestant(usr, nprob) {
	var contestantData = {};

	contestantData.user = usr;
	contestantData.submissions = [];

	for(var i=0;i<nprob;i++)
		contestantData.submissions.push([-1,0]);

	contestantData.score = {};
	contestantData.score.pts = 0;
	contestantData.score.penalty = 0;

	return contestantData;
}

function editContest() {
	var contestData = {};

	if(vId == false) return;
	var alias = txtId.value;

	if(!vName) return;
	contestData.name = txtName.value;

	if(!vStart) return;
	contestData.start = dtStart.value;

	if(!vEnd) return;
	contestData.end = dtEnd.value;

	contestData.lastUpdate = contestData.start;
	contestData.penaltyPerMin = 1;
	contestData.penaltyPerWA = 20;

	var plist = document.getElementsByClassName("list-container")[0];
	if(plist.children.length == 0) return;

	contestData.problems = [];

	for(var i=0;i<plist.children.length;i++) {
		contestData.problems.push(parseInt(plist.children[i].children[0].innerHTML.substr(0,4)));
	}

	var ulist = document.getElementsByClassName("list-container")[1];
	if(ulist.children.length == 0) return;

	contestData.contestants = [];

	for(var i=0;i<ulist.children.length;i++) {
		contestData.contestants.push(createContestant(
			ulist.children[i].children[1].innerHTML,
			contestData.problems.length));
	}

	var encodedData = JSON.stringify(contestData);	
	storeDataInDB(alias, encodedData);
}

function storeDataInDB(key, data) {
	var xhr = new XMLHttpRequest();

	var url = "api-edit-contest.php?id=" + key + "&data=" + encodeURIComponent(data);

	xhr.open("GET", url);

	xhr.onload = function() {
		if(xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);

			if(data.result == "success") {
				showMessage("Concurso actualizado correctamente!", "success", function() {
					setTimeout(function() {
						window.location.replace("admin-index.php");
					}, 500);
				})
			}
			else {
				showMessage("No se pudo actualizar el concurso debido a un error.", "error");
			}
		}
	}
	xhr.send();
}

window.addEventListener("load", function() {

	txtId = document.getElementById("contest-id");
	txtName = document.getElementById("contest-name");
	dtStart = document.getElementById("contest-start-date");
	dtEnd = document.getElementById("contest-end-date");
	txtProblem = document.getElementById("problem");
	btnAddProblem = document.getElementById("add-problem");
	txtUser = document.getElementById("user");
	divOptions = document.getElementsByClassName("options")[0];
	btnAddUser = document.getElementById("add-user");
	btnCreate = document.getElementById("create-contest");

	txtId.addEventListener("keyup", validateId);
	txtName.addEventListener("keyup", validateName);
	dtStart.addEventListener("keyup", validateStart);
	dtEnd.addEventListener("keyup", validateEnd);
	txtProblem.addEventListener("keyup", validateProblem);
	txtUser.addEventListener("keyup", validateUser);

	btnAddProblem.addEventListener("click", function() {
		addProblem(txtProblem.value);
	});

	btnAddUser.addEventListener("click", function() {
		addUser(txtUser.value);
	});

	btnCreate.addEventListener("click", editContest);

	validateId();
	validateName();
	validateStart();
	validateEnd();
});