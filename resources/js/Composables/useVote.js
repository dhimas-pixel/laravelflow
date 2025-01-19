import { router } from "@inertiajs/vue3";

export default (resource, routeName) => {
    const vote = (vote) => {
        router.post(
            route(routeName, resource.id),
            {
                vote,
            },
            {
                preserveScroll: true,
            }
        );
    };

    const upVote = () => {
        vote(1);
    };

    const downVote = () => {
        vote(-1);
    };

    return {
        upVote,
        downVote,
    };
};
