const addBtn = document.querySelector('#btn');
addBtn.addEventListener('click',addTask);
const taskCard = document.querySelector('.todoCard');
const tasksContainer = document.querySelector("#todoCards");

const delBtn = document.querySelector('.delBtn');
delBtn.addEventListener('click', function(){
    deleteTask(taskCard);
});

function countTask(){
    const countCard = document.querySelector('#count'); //l'element count
    const listTask = tasksContainer.querySelectorAll('.todoCard');//tous les todoCard dans tasksContainer
    for (let i = 0;i <= listTask.length();i++){//pour tous les element de listTask
        countCard.innerText = "task = "+i; //écrire dans countCard
    }
}

function addTask(){
    const newTask = taskCard.cloneNode(true)//clone the task card
    const newDelBtn = newTask.querySelector('.delBtn')
    const newTextArea = newTask.querySelector('.task')
    
    newTextArea.value = "New Task"
    newDelBtn.addEventListener('click', function(){
        deleteTask(newTask);
    });

    tasksContainer.appendChild(newTask)
    countTask();
}

function deleteTask(task){
    task.remove();
}