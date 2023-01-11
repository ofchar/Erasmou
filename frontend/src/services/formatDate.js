export const formatDate = function (dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('de', {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric'
    }).format(date);
}