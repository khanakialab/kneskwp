import React, { Component } from "react";
import { inject, observer } from 'mobx-react';


@observer
class Layout extends Component {
    constructor(props) {
        super(props);
    }

    static defaultProps = {
      
    }

    render() {  
        // console.log(Sapp.Store)
        return (
            <div className={"helloComp"}>
                HELLO WORLD2 from Store {Knesk.Store.globalStore.name}
            </div>
        );
    }
}

export default Layout;
