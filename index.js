import * as Fm from './fm/src-react'
window.Knesk = Fm

//## REACT COMPONENTS
import HelloWorld from './app-react/components/HelloWorld'
Knesk['Comps'] = {
    HelloWorld
}

//// STYLES
import "./node_modules/@bower_components/bootstrap/dist/css/bootstrap.css"
import "./resources/assets/scss/main.scss"