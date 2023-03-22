const books = document.querySelector('.books')
const submit = document.querySelector('.submit')

submit.addEventListener('click', get_title)



function get_title() {
    let search = document.querySelector('.search');
    let input_search = search.value;

    if (input_search === '') {
        console.log("ily'ariengros");
    } else {
        const url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input_search}&key=AIzaSyAWiQgc3w3i861FmrPuDkRfNQn5Uw_bhHI`;

        fetch(url, {
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "Content-type": "application/json",
            }
        })
        .then(res => res.json())
        .then((data) => {
            console.log(data);
            if (data.items && data.items.length > 0) {
                let booksHTML = '';
                data.items.forEach(item => {
                    let bookTitle = item.volumeInfo.title;
                    let bookAuthor = item.volumeInfo.authors ? item.volumeInfo.authors.join(', ') : 'Auteur inconnu';
                    let bookDescription = item.volumeInfo.description ;
   
                    if(bookDescription && bookDescription.length > 350){
                    bookDescription = bookDescription.substring(0,350)+ '...';
                    }else{
                    bookDescription = "pas de description disponible"
                    }

                    let bookThumbnail = item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : 'https://via.placeholder.com/128x192.png?text=Image+indisponible';
                    let bookInfoLink = item.volumeInfo.infoLink;

                    let bookHTML = `
                        <div class="book-card">
                            <div class="book-thumbnail">
                                <img src="${bookThumbnail}" alt="Miniature du livre ${bookTitle}">
                            </div>
                            <div class="book-details">
                                <h2 class="book-title">${bookTitle}</h2>
                                <p class="book-author">${bookAuthor}</p>
                                <p class="book-description">${bookDescription}</p>
                                <a href="${bookInfoLink}" class="book-link" target="_blank">En savoir plus</a>
                               
                            </div>
                        </div>
                    `;

                    booksHTML += bookHTML;
                });

                books.innerHTML = booksHTML;
            } else {
                books.innerHTML = '<p>Aucun livre trouvé</p>';
            }
        })
        .catch(e => console.log(e));
    }
}
