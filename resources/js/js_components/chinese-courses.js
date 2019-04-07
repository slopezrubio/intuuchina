function toggleDescription(){
    var onlineDescription = document.querySelector('.online-description');
    var presencialDescription = document.querySelector('.classroom-description');
    var courseInfo = document.getElementById('course-information');

    onlineDescription.classList.toggle('description-disabled');
    presencialDescription.classList.toggle('description-disabled');
    courseInfo.classList.toggle('bg-classroom-course');
    courseInfo.classList.toggle('bg-online-course')
};