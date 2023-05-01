import InputError from '@/Components/InputError'
import InputLabel from '@/Components/InputLabel'
import PrimaryButton from '@/Components/PrimaryButton'
import TextInput from '@/Components/TextInput'
import { useForm, usePage } from '@inertiajs/react'
import { Transition } from '@headlessui/react'

const UpdateSteamForm = ({ className = '' }) => {
    const user = usePage().props.auth.user

    console.log(user)

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        steam: user.steam,
    })

    const submit = (e) => {
        e.preventDefault()

        patch(route('profile.update'))
    }

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">Update Steam Profile Link</h2>

                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update the information connecting this account to your steam account.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="steam" value="Steam Value" />

                    <TextInput
                        id="steam"
                        className="mt-1 block w-full"
                        value={data.steam ? data.steam : ""}
                        onChange={(e) => setData('steam', e.target.value)}
                        required
                        isFocused
                    />

                    <InputError className="mt-2" message={errors.steam} />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enterFrom="opacity-0"
                        leaveTo="opacity-0"
                        className="transition ease-in-out"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    )
}

export default UpdateSteamForm
