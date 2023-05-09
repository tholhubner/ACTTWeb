import React from "react"
import { Link } from '@inertiajs/react'

const BasicNav = ({ auth, environment }) => {
    console.log(environment)
    return (
        <>
            <div className="sm:fixed sm:top-0 sm:left-0 p-6 text-left">
                <Link
                    onClick={() => window.location.href = "/"}
                    className="font-xl font-bold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    AC Time Trials
                </Link>
            </div>
            <div className="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                {auth.user ? (
                    <Link
                        href={route('dashboard')}
                        className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        Dashboard
                    </Link>
                ) : (
                    <>
                        { environment !== "production" && (
                            <>
                                <Link
                                    href={route('login')}
                                    className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                >
                                    Log in
                                </Link>

                                <Link
                                    href={route('register')}
                                    className="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </>
                )}
            </div>
        </>
    )
}

export default BasicNav
