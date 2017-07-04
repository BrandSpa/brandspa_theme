import React, { Component } from 'react';
import request from 'axios';
import qs from 'qs';
const endpoint = '/wp-admin/admin-ajax.php';

class Contact extends Component {
  state = {
      name: '',
      email: '',
      phone: '',
      company: '',
      question: '',
      errors: {}
  }

  handleChange = e =>  {
    let field = e.target.name;
    let val = e.target.value;
    this.setState({[field]: val});
  }

  handleSubmit = e => {
    e.preventDefault();
    const data = qs.stringify({action: 'store_contact', data: this.state});

    request
    .post(endpoint, data)
    .then(({data}) => {

      if(Object.keys(data).length > 0) {
        this.setState({errors: data});
      }

    })

  }

  render() {
    return (
      <form className="form-contact">
        <div className="form-group">
          <input name="name" type="text" className="form-control" placeholder="Nombre"/>
        </div>
        <div className="form-group">
          <input name="email" type="text" className="form-control" placeholder="Email"/>
        </div>
        <div className="form-group">
          <input name="phone" type="text" className="form-control" placeholder="Teléfono"/>
        </div>
        <div className="form-group">
          <input name="company" type="text" className="form-control" placeholder="Empresa"/>
        </div>
        <div className="form-group">
          <textarea name="question" rows="4" className="form-control" placeholder="¿Dudas?"/>
        </div>
        <button>

        </button>
      </form>
    )
  }
}

export default Contact;
