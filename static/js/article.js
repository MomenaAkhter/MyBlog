window.onload = function () {
  const loadComments = function () {
    const articleId = document.getElementById('article-id').value

    get(`../api/article.php?action=filter&article-id=${articleId}`, function (response) {
      let comments = []

      if (response !== 'null' && response.trim().length > 0) {
        comments = JSON.parse(response)
        const commentsElement = document.querySelector('.comments')

        commentsElement.innerHTML = ''

        comments.forEach(function (comment) {
          commentsElement.innerHTML +=
        `<div class='comment'>
            <div class='header'>
              <b>${comment.user_name}</b> ${comment.creation_timestamp}
            </div>
            <div class='body'>${comment.body}</div>
         </div>`
        })
      }

      document.getElementById('comments-count').innerHTML = `Comments (${comments.length})`
    })
  }

  document.getElementsByTagName('form')[0].onsubmit = function (e) {
    const body = document.getElementById('body').value
    const articleId = document.getElementById('article-id').value
    post('../api/article.php', `action=create&body=${body}&article-id=${articleId}`, function (response) {
      if (response === 'ok') { document.getElementById('messages').innerHTML = "<div class='message is-success'>Comment posted successfully!</div>" }
    })

    loadComments()

    e.preventDefault()
  }

  loadComments()
}
