import React from 'react'
import ReactDOM from 'react-dom'
window.React = React
window.ReactDOM = ReactDOM

// Include Store
import Store from './store'
// Sapp.Store = StoreClass

let RenderComp = (COMP, elementId, props={} ) => {
    ReactDOM.hydrate(<COMP {...props} />, document.getElementById(elementId))
}

export {
    Store,
    RenderComp
}