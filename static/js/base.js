const get = function (location, cb) {
  var xhttp = new XMLHttpRequest()
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      cb(this.responseText)
    }
  }
  xhttp.open('GET', location, true)
  xhttp.send()
}

const post = function (location, data, cb) {
  var xhttp = new XMLHttpRequest()
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      cb(this.responseText)
    }
  }
  xhttp.open('POST', location, true)
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
  xhttp.send(data)
}
