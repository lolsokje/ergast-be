export default interface DriverRace {
    id: Number,
    race: string,
    date: string,
    grid: Number | null,
    position: Number | null,
    status: string | null,
    team: string,
    url: string | null,
};
