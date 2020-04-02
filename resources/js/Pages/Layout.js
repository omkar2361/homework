import React, { useEffect } from 'react'
import { InertiaLink } from '@inertiajs/inertia-react'

export default function Layout({ title, children }) {
  useEffect(() => {
    document.title = title;
  }, [title])

  return (
    <main>
      <header className="navbar navbar-expand-lg navbar-light bg-light">
        <InertiaLink className="nav-link" href="/">Home</InertiaLink>
        <InertiaLink className="nav-link" href="/about">About</InertiaLink>
        <InertiaLink className="nav-link" href="/contact">Contact</InertiaLink>
      </header>

      <article>{children}</article>

      
    </main>
   
  )
}