import { Head } from '@inertiajs/react'
import Logo from "../Components/Logo"
import BasicNav from "@/Components/BasicNav";

export default function Welcome({ auth, appVersion }) {
    return (
        <>
            <Head title="Welcome" />
            <div className="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                <BasicNav auth={auth} />

                <div className="max-w-full my-20">
                    <div className="hero bg-base-200 max-w-full">
                        <div className="hero-content text-center flex-col py-20 px-20">
                            <Logo />
                            <div className="max-w-lg">
                                <h1 className="text-5xl font-bold">AC Ranked Time Trials</h1>
                                <p className="py-6">The premiere place to test your skills against other drivers within Assetto Corsa. Get started below and see you on track!</p>
                                <button className="btn btn-primary" onClick={() => window.location.href = "/start"}>Get Started</button>
                            </div>
                        </div>
                    </div>

                    <div className="flex justify-center mt-16 px-6 sm:items-center">
                        <div className="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                            ACTT v{appVersion}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
