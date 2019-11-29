import React, {Component} from 'react';

import axios from 'axios';

import Tree from './components/Tree'

import './App.css';

axios.defaults.baseURL      = '';
//axios.defaults.baseURL      = 'http://localhost:9090';


export class App extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Tree />
        );
    }
}


export default App;
