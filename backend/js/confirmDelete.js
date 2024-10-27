function confirmDelete(link) {
    var result = confirm("Вы уверены, что хотите удалить этот элемент?");
    if (result) {
        window.location.href = link
    }
}
