import React from "react"
import Authenticated from "@/Layouts/AuthenticatedLayout"
import { Head } from "@inertiajs/react"

const Index = ({ auth }) => {
	return (
		<Authenticated user={auth.user} auth={auth}>
			<Head title="Users" />
		</Authenticated>
	)
}

export default Index
