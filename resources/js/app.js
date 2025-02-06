import './bootstrap';


let buttonLike = document.querySelectorAll('.likeButton');
buttonLike.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');

        axios.post(`/posts/${id}/add/like`)
            .then(response => {
                document.getElementById('likeCount').textContent = response.data.likes
            })
            .catch(error => {
                console.log('Error:')
            });


    })
});
