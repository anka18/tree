import React from 'react';

import axios from 'axios';
import {Treebeard} from 'react-treebeard';

import ElementForm from './ElementForm';
//import CategoryForm from './CategoryForm';

export class Tree extends React.Component {
  constructor(props) {
      super(props);
      this.state = {
          data: null,
          node: null,
          form: null,
          elem: [{
              date_create: '',
              date_mod: '',
              description: ''
              }
          ]
      };
  }

  loadData() {
      axios.get(`${axios.defaults.baseURL}/api/catalog/`)
        .then(res => {
            this.setState({ data: res.data[0] });
        });
  }

  componentDidMount(){
      this.loadData();
  }


  addCategory(value, other) {
      if (this.state.node) {
          const data = {parent_id: this.state.node.id, name: value, other: other};
          axios.post(`${axios.defaults.baseURL}/api/catalog/category/`, {data})
              .then(res => {
                  const node = this.state.node;
                  node.active = true;
                  node['children'].push({
                      active: true,
                      toggled: false,
                      ...res.data[0],
                  });
                  this.setState({
                      node: null,
                  });
              });
      }
  }

  delItem(e) {
      e.preventDefault();
      if (this.state.node) {
          let data = {};
          let url = null;
          if (this.state.node.element_type === 'element') {
              url  = `${axios.defaults.baseURL}/api/catalog/category/element/`;
              data = { id: this.state.node.element_id };
          } else {
              url  = `${axios.defaults.baseURL}/api/catalog/category/`;
              data = { id: this.state.node.id };
          }
          axios.delete(url, {data: data})
              .then(res => {
                  this.loadData();
                  this.setState({node: null});
              });
      }
  }

  addElement(value, other) {
      if (this.state.node) {
          const data = {category_id: this.state.node.id, name: value, other: other};
          axios.post(`${axios.defaults.baseURL}/api/catalog/category/element/`, {data})
              .then(res => {
                  const node = this.state.node;
                  node.active = true;
                  node['children'].push({
                      active: true,
                      toggled: false,
                      ...res.data[0],
                  });
                  this.setState({
                      node: null,
                  });
              });
      }
  }

  onToggle(node, toggled){
      const {cursor, data} = this.state;

      if (cursor) {
          cursor.active = false;
      }
      node.active = true;

      if (node.children) {
          node.toggled = toggled;
      }

      this.setState(() => ({
          node: node,
          cursor: node,
          data: Object.assign({}, data)}));
      let text= '';
      if (node.other){
          text = node.other;
      } else {
          text = node.description;
      }
      this.setState ({
          date_create: node.date_create,
          date_mod: node.date_mod,
          description: text
      })

  }

  render() {
      if (this.state.data === null) {
          return (<div></div>);
      }
      const data = this.state.data;
      data['toggled'] = true;
      return (
          <div>
              <div className="main-wrapper">
                  <div className="left">
                      <Treebeard data={data} onToggle={(node, toggled) => this.onToggle(node, toggled)}/>
                  </div>
                  <div className="right">
                      <div >
                          <button onClick={(e) => this.delItem(e)} className={this.state.node !== null ? 'active form': 'form'}>
                              Remove
                          </button>
                          <div className={this.state.node !== null && this.state.node.element_type === 'category' ? 'active form': 'form'}>
                              <ElementForm
                                  addElement={(value, other) => this.addElement(value, other)}
                                  addCategory={(value, other) => this.addCategory(value, other)}
                              />
                          </div>
                      </div>
                  </div>
              </div>
              <div>
                  <ul className="list">
                      <li>Date of creation: {this.state.date_create}</li>
                      <li>Date of change: {this.state.date_mod}</li>
                      <li>Description: {this.state.description}</li>
                  </ul>
              </div>
          </div>
      );
  }
}

export default Tree;
