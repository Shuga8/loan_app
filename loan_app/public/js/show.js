function show() {
    let x = document.querySelector('#pass')

    if (x.type === "password") {
        x.type = "text"
    } else {
        x.type = "password"
    }

}


function showPass() {
    let y = document.querySelector('#pass1')
    let z = document.querySelector('#pass2')

    if (y.type === "password") {
        y.type = "text"
    } else {
        y.type = "password"
    }

    if (z.type === "password") {
        z.type = "text"
    } else {
        z.type = "password"
    }
}

function changeShow() {
    let a = document.querySelector('#new1')
    let b = document.querySelector('#new2')
    let c = document.querySelector('#new3')

    if (a.type === "password") {
        a.type = "text"
    } else {
        a.type = "password"
    }

    if (b.type === "password") {
        b.type = "text"
    } else {
        b.type = "password"
    }

    if (c.type === "password") {
        c.type = "text"
    } else {
        c.type = "password"
    }
}