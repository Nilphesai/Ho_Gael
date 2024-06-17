const addBtn = document.querySelector('#btn');
addBtn.addEventListener('click',addTask);
const taskCard = document.querySelector('.todoCard');
const tasksContainer = document.querySelector("#todoCards");

const delBtn = document.querySelector('.delBtn');
delBtn.addEventListener('click', function(){
    deleteTask(taskCard);
});

function addTask(){
    const newTask = taskCard.cloneNode(true)//clone the task card
    const newDelBtn = newTask.querySelector('.delBtn')
    const newTextArea = newTask.querySelector('.task')

    newTextArea.value = "New Task"
    newDelBtn.addEventListener('click', function(){
        deleteTask(newTask);
    });

    tasksContainer.appendChild(newTask)
}

function deleteTask(task){
    task.remove();
}