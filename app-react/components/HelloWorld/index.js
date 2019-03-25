import React, { Component } from "react";
import scss from './index.scss'
class Hello extends Component {
    constructor(props) {
        super(props);
        this.state = {
            name: this.props.name
        }
    }

    static defaultProps = {
      
    }

    changeName = () => {
        // Sapp.Store.globalStore.name = "aaa"
        this.setState({
            name: Math.random(100)
        })
    }

    render() {  
        Knesk.Store.globalStore.name = this.state.name
        return (
            <div className={"helloComp"}>
                HELLO WORLD {this.state.name}
                <button onClick={this.changeName}>Change Name</button>
            </div>
        );
    }
}

export default Hello;
