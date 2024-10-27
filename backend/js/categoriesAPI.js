document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    const name = document.getElementById('name').value;

    const apiUrl = `http://testproject/backend/api/categories.php/?name=${encodeURIComponent(name)}`;

    // Открываем новую страницу с результатами
    window.open(apiUrl, '_blank');
});
