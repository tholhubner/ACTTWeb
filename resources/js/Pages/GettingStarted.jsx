import React from "react"
import { Head } from '@inertiajs/react'
import BasicNav from "@/Components/BasicNav"

const GettingStarted = ({ auth }) => {
    return (
        <>
            <Head title="Getting Started" />
            <div className="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                <BasicNav auth={auth} />
            </div>
        </>
    )
}

export default GettingStarted
