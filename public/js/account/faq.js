var data;

function updateFAQ(inboundData) {

    data = inboundData;
    var wrapper = document.querySelector(".popup-wrapper");
    var count = 0;

    for (var i = 0; i < data.length; i++) {
        var card = document.createElement("div");
        card.classList.add("card");

        var idDiv = document.createElement("div");
        idDiv.classList.add("id");
        idDiv.innerHTML = data[i].id;

        var questionDiv = document.createElement("div");
        questionDiv.classList.add("question");
        questionDiv.innerHTML = data[i].question;
        questionDiv.id = "question-" + data[i].id;

        var answerDiv = document.createElement("div");
        answerDiv.classList.add("answer");
        answerDiv.innerHTML = data[i].answer;
        answerDiv.id = "answer-" + data[i].id;

        var actionsDiv = document.createElement("div");
        actionsDiv.classList.add("actions");
        actionsDiv.id = "actions-" + data[i].id;

        var trashImg = document.createElement("img");
        trashImg.src = "/public/svg/account/trash.svg";
        trashImg.id = "trash-" + data[i].id;
        trashImg.onclick = function () {
            removeQuestion(this.id.split("-")[1]);
        }

        var editImg = document.createElement("img");
        editImg.src = "/public/svg/account/edit.svg";
        editImg.id = "edit-" + data[i].id;
        editImg.onclick = function () {
            editQuestion(this.id.split("-")[1]);
        }

        actionsDiv.appendChild(editImg);
        actionsDiv.appendChild(trashImg);
        card.appendChild(idDiv);
        card.appendChild(questionDiv);
        card.appendChild(answerDiv);
        card.appendChild(actionsDiv);
        wrapper.appendChild(card);
        count++;
    }
}

function editQuestion(id) {
    var question = document.querySelector("#question-" + id)
    var answer = document.querySelector("#answer-" + id)
    var questionText = question.innerHTML;
    var answerText = answer.innerHTML;
    var trashImg = document.querySelector("#trash-" + id);
    var editImg = document.querySelector("#edit-" + id);

    question.style.display = "none";
    answer.style.display = "none";
    editImg.style.display = "none";
    trashImg.style.display = "none";

    var questionInput = document.createElement("input");
    questionInput.type = "text";
    questionInput.value = questionText;
    questionInput.classList.add("question");
    questionInput.classList.add("input");


    var answerInput = document.createElement("input");
    answerInput.type = "text";
    answerInput.value = answerText;
    answerInput.classList.add("answer");
    answerInput.classList.add("input");

    var saveImg = document.createElement("img");
    saveImg.src = "/public/svg/account/validate.svg";
    saveImg.id = "save-" + id;

    var cancelImg = document.createElement("img");
    cancelImg.src = "/public/svg/account/cancel.svg";
    cancelImg.id = "cancel-" + id;

    var actionsDiv = document.querySelector("#actions-" + id);
    actionsDiv.appendChild(saveImg);
    actionsDiv.appendChild(cancelImg);

    question.parentNode.insertBefore(questionInput, question.nextSibling);
    answer.parentNode.insertBefore(answerInput, answer.nextSibling);

    cancelImg.onclick = function () {
        question.style.display = "block";
        answer.style.display = "block";
        editImg.style.display = "block";
        trashImg.style.display = "block";
        questionInput.remove();
        answerInput.remove();
        saveImg.remove();
        cancelImg.remove();
    }

    saveImg.onclick = function () {
        var newQuestion = questionInput.value;
        var newAnswer = answerInput.value;

        data = data.map(function (item) {
            if (item.id == id) {
                item.question = newQuestion;
                item.answer = newAnswer;
            }
            return item;
        });

        question.innerHTML = newQuestion;
        answer.innerHTML = newAnswer;

        question.style.display = "block";
        answer.style.display = "block";
        editImg.style.display = "block";
        trashImg.style.display = "block";
        questionInput.remove();
        answerInput.remove();
        saveImg.remove();
        cancelImg.remove();
    }
}

function removeQuestion(id) {

    data = data.filter(function (item) {
        return item.id != id;
    });

    var card = document.querySelector("#question-" + id).parentNode;
    card.remove();
}

function saveFAQ() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/account/updateFAQ");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));

    xhr.onload = function () {
        if (xhr.status == 200) {
            alert(this.responseText);
        }
    }
}

function addNewQuestion() {
    var newId;
    try {
        newId = data[data.length - 1].id + 1;
    } catch (error) {
        newId = 1;
    }
    var question = "New question";
    var answer = "New answer";

    try {
        data[data.length] = {
            id: newId,
            question: question,
            answer: answer
        };
    } catch (error) {
        data[0] = {
            id: newId,
            question: question,
            answer: answer
        };
    }
    
    //create new card
    var wrapper = document.querySelector(".popup-wrapper");
    var card = document.createElement("div");
    card.classList.add("card");

    var idDiv = document.createElement("div");
    idDiv.classList.add("id");
    idDiv.innerHTML = newId;


    var questionDiv = document.createElement("div");
    questionDiv.classList.add("question");
    questionDiv.innerHTML = question;
    questionDiv.id = "question-" + newId;


    var answerDiv = document.createElement("div");
    answerDiv.classList.add("answer");
    answerDiv.innerHTML = answer;
    answerDiv.id = "answer-" + newId;

    var actionsDiv = document.createElement("div");
    actionsDiv.classList.add("actions");
    actionsDiv.id = "actions-" + newId;

    var trashImg = document.createElement("img");
    trashImg.src = "/public/svg/account/trash.svg";
    trashImg.id = "trash-" + newId;
    trashImg.onclick = function () {
        removeQuestion(this.id.split("-")[1]);
    }

    var editImg = document.createElement("img");
    editImg.src = "/public/svg/account/edit.svg";
    editImg.id = "edit-" + newId;
    editImg.onclick = function () {
        editQuestion(this.id.split("-")[1]);
    }

    actionsDiv.appendChild(editImg);
    actionsDiv.appendChild(trashImg);
    card.appendChild(idDiv);
    card.appendChild(questionDiv);
    card.appendChild(answerDiv);
    card.appendChild(actionsDiv);
    wrapper.appendChild(card);

    editQuestion(newId);
}   