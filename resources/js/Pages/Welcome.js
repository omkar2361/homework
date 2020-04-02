import React, {useState} from 'react'
import Layout from './Layout'
import {Inertia} from '@inertiajs/inertia'

export default function Welcome() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
 
  const loginUser = event => {
    event.preventDefault();

    Inertia.post('/login',{
      email,
      password
    }).then(() =>{
      //code
      
    })
  }
  return (
    <Layout title="Welcome">
      <div className="container">
      <form  onSubmit={loginUser}>
        <div className="form-group">
          <label htmlFor="exampleInputEmail1">Email address</label>
          <input type="email" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" onChange={(e) => setEmail(e.target.value)}></input>
          <small id="emailHelp" className="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div className="form-group">
          <label htmlFor="exampleInputPassword1">Password</label>
          <input type="password" className="form-control" id="exampleInputPassword1" placeholder="Password" onChange={(e) => setPassword(e.target.value)}></input>
        </div>
        
        <button type="submit" className="btn btn-primary">Submit</button>
      </form>
      </div>
      
    </Layout>


  )
}