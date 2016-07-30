var clock;

function rankingTable(data) {
	//Adding header of the table
	var str = '<tr class="scoreboard-table-header">' +
				'<th>Pos</th>' +
				'<th width="100%">Usuario</th>';

	for(var i=0;i<data.problems.length;i++) {
		str += '<th class="problem"><a href="http://coj.uci.cu/24h/problem.xhtml?pid='+
		data.problems[i] + '">' +
		String.fromCharCode(i+65) +'</a></th>';
	}
	str += '<th>Pts.</th>'
	str += '</tr>';

	//Getting the first solver of every problem
	var firstSolvers = [];
	for(var i=0;i<data.problems.length;i++) {
		firstSolvers[i] = { user: '', time: 100000000 };

		for(var j=0;j<data.contestants.length;j++) {
			var cnt = data.contestants[j];

			if(cnt.submissions[i][0] != -1 && cnt.submissions[i][0] < firstSolvers[i].time) {
				firstSolvers[i].time = cnt.submissions[i][0];
				firstSolvers[i].user = cnt.user;
			}
		}
	}

	var veryFirst = { user: '', time: 100000000, index: -1};

	for(var i=0;i<firstSolvers.length;i++) {
		if(firstSolvers[i].time < veryFirst.time) {
			veryFirst.user = firstSolvers[i].user;
			veryFirst.time = firstSolvers[i].time;
			veryFirst.index = i;
		}
	}

	updateFaster(veryFirst.user);

	//Adding users
	for(var i=0;i<data.contestants.length;i++) {
		str += '<tr>';
		str += '<td>' + (i+1) + '</td>';
		str += '<td>' + data.contestants[i].user + '</td>';

		var subs = data.contestants[i].submissions;
		for(var j=0;j<data.problems.length;j++) {

			if(subs[j][0] != -1) {
				str += '<td class="ac';

				if(firstSolvers[j].user == data.contestants[i].user) 
					str += ' first-ac-problem';
				if(veryFirst.user == data.contestants[i].user && veryFirst.index == j)
					str += ' first-ac-contest';

				str += '">'+subs[j][0]+'/'+subs[j][1]+'</td>';
			}
			else {
				str +='<td>-/';
					str += (subs[j][1] > 0) ? subs[j][1] : '-';
				str +='</td>';
			}				 
		}

		str += '<td>' + data.contestants[i].score.pts +
			   '('+data.contestants[i].score.penalty+')</td>';

		str += '</tr>';
	}

	return str;
}

function updateTop3() {
	var top3 = document.getElementsByClassName('top-three')[0];

	for(var i=0;i<3;i++) {
		var user = data.contestants[i].user;
		if(user != top3.children[i+1].children[1].innerText) {
			top3.children[i+1].children[0].src = "http://coj.uci.cu/images/avatars/" + user;
			top3.children[i+1].children[1].innerText = user;
		}
	}
}


function updateFaster(user) {
	var faster = document.getElementsByClassName('fastest-place')[0];

	if(user != faster.children[1].innerText) {
		faster.children[0].src = "http://coj.uci.cu/images/avatars/" + user;
		faster.children[1].innerText = user;
	}
}

function setError(str) {
	var main = document.getElementsByClassName('main')[0];
	main.innerHTML = '<h1 style="margin: 220px auto;">'+str+'</h1>';
}

function toHHMMSS(sec) {
    var hours   = Math.floor(sec / 3600);
    var minutes = Math.floor((sec - (hours * 3600)) / 60);
    var seconds = sec - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}

function updateClock() {
	clearInterval(clock);
	var clockDOM = document.getElementsByClassName('clock')[0].children[0];
	clockDOM.style.visibility = "visible";
	
	clock = setInterval( function() {
			var time = Math.floor((new Date(data.end.replace(/-/g, "/")).getTime() / 1000) - (new Date().getTime()/1000));
			clockDOM.innerHTML = toHHMMSS(time);
			if(time <= 0) {
				clockDOM.innerHTML = "Finalizado.";
				clearInterval(clock);
			}
	},1000);
}

function updateData(newData) {
	data = newData;

	if(data.error == "not founded") {
		setError("El concurso que buscas no existe.");
		document.getElementsByClassName('main')[0].style.display = "flex";
		return;
	}

	document.getElementsByClassName('main')[0].style.display = "flex";

	// Updating the contest name
	document.getElementsByClassName('contest-name')[0].innerHTML = data.name;

	// Updating the scoreboard
	var table = document.getElementsByClassName('scoreboard-table')[0];
	table.innerHTML = rankingTable(data);

	// Updating the top 3 contestants
	updateTop3();

	updateClock();
}

function getData(id) {
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "api-contest.php?id=" + id);

	xhr.onload = function() {
		if(xhr.status == 200)
			updateData(JSON.parse(xhr.responseText));
	}
	xhr.send();
}

window.addEventListener("load",function() {
	var contestID = document.getElementsByClassName('contest-name')[0].innerHTML;
	getData(contestID);

	setInterval(function() {
		getData(contestID);
	},5000);
});