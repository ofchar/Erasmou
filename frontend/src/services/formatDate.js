export const formatDate = function (dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('en', {dateStyle: 'long'}).format(date);
}