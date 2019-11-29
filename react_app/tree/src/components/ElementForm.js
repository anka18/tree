import React, {Component} from 'react';

class ElementForm extends Component {
    constructor(props){
        super(props);
        this.state = {value: '', other: '' };
    }

    handleChangeValue(event) {
        this.setState({value: event.target.value});
    }

    handleChangeOther(event) {
        this.setState({other: event.target.value});
    }

    onAddElement(e) {
        e.preventDefault();
        this.props.addElement(this.state.value, this.state.other);
        this.setState({value: '', other: '' });
    }

    onAddCategory(e) {
        e.preventDefault();
        this.props.addCategory(this.state.value, this.state.other);
        this.setState({value: '', other: '' });
    }

    // <input className="btn" type="button" value="Add" onClick={(e) => this.onAddElement()} />
    // className={this.state.node && this.state.node.element_type === 'category' ? 'active form': 'form'}
    render() {
        return (
            <form>
                <label>
                    <span>Name</span>
                    <input type="text" value={this.state.value} onChange={(e) => this.handleChangeValue(e)} />
                </label>
                <label>
                    <span>Description</span>
                    <input type="text" value={this.state.other} onChange={(e) => this.handleChangeOther(e)} />
                </label>

                <button onClick={(e) => this.onAddElement(e)} className="btn" disabled={!this.state.other.length || !this.state.value.length}>
                    Add element
                </button>

                <button onClick={(e) => this.onAddCategory(e)}  className="btn" disabled={!this.state.other.length || !this.state.value.length}>
                    Add category
                </button>
            </form>
        )
    }
}

export default ElementForm;
