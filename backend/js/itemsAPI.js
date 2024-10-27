document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    const name = document.getElementById('name').value;
    const page = document.getElementById('page').value;

    const apiUrl = `http://testproject/backend/api/items.php/?name=${encodeURIComponent(name)}&page=${encodeURIComponent(page)}`;

    // Открываем новую страницу с результатами
    window.open(apiUrl, '_blank');
});
